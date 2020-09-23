<?php

//get the jokes count
//Database object refers to the pdo object instance
// function totalJokes($Database){
//   $query = $Database->prepare('SELECT count(*) FROM joke');
//   $query->execute();
//   $result = $query->fetch();
//   return $result[0];
// }

function totalJokes($Database){
  $query = query($Database,'SELECT count(*) FROM joke');  // using query function
  $result = $query->fetch();
  return $result[0];
}
function allJokes($pdo) {
  $jokes = query($pdo, 'SELECT `joke`.`id`, `joketext`,`jokedate`,
  `name`, `email`
  FROM `joke` INNER JOIN `author`
  ON `authorid` = `author`.`id`');
  return $jokes->fetchAll();
}
function allAuthors($pdo) {
  $authors = query($pdo, 'SELECT * FROM `author`');
  return $authors->fetchAll();
}
// get single joke
// function getJoke($Database,$id){
//   $query = $Database->prepare('SELECT * FROM joke WHERE id = :id');
//   $query->bindValue(':id',$id);
//   $query->execute();
//   return $query->fetch();
// }
function getJoke($Database,$id){
  $parameters =[':id'=>$id];
  $query = query($Database,'SELECT * FROM joke WHERE id = :id',$parameters);  
  return $query->fetch();
}

//query abstraction

// function query($pdo,$sql){
//   $query = $pdo->prepare($sql);
//   $query->execute();
//   return $query;
// }

// function query($pdo,$sql,$parameters=[]){// needs at least 2 params
//   $query = $pdo->prepare($sql);
//   foreach($parameters as $name=>$value){
//     $query->bindValue($name,$value); 
//   }
//   $query->execute();
//   return $query;
// }

function query($pdo, $sql, $parameters = []) {
  $query = $pdo->prepare($sql);
  $query->execute($parameters);
  return $query;
}

function processDates($fields) {
  foreach ($fields as $key => $value) {
    if ($value instanceof DateTime) {
    $fields[$key] = $value->format('Y-m-d');
    }
  }
  return $fields;
}

//insert record to database

// function insertJoke($pdo, $joketext, $authorId) {
//   $query = 'INSERT INTO `joke` (`joketext`, `jokedate`,
//   `authorId`) VALUES (:joketext, CURDATE(), :authorId)';
//   $parameters = [':joketext' => $joketext, ':authorId'
//   => $authorId];
//   query($pdo, $query, $parameters);
// }

function insertJoke($pdo, $fields) {
  $query = 'INSERT INTO `joke` (';
  foreach ($fields as $key => $value) {
    $query .= '`' . $key . '`,';
  }
  $query = rtrim($query, ',');
  $query .= ') VALUES (';
  foreach ($fields as $key => $value) {
    $query .= ':' . $key . ',';
  }
  $query = rtrim($query, ',');
  $query .= ')';
  // date formatting
  $fields = processDates($fields);
    query($pdo, $query,$fields);
}

function insertAuthor($pdo, $fields) {
  $query = 'INSERT INTO `author` (';
  foreach ($fields as $key => $value) {
  $query .= '`' . $key . '`,';
  }
  $query = rtrim($query, ',');
  $query .= ') VALUES (';
  foreach ($fields as $key => $value) {
  $query .= ':' . $key . ',';
  }
  $query = rtrim($query, ',');
  $query .= ')';
  $fields = processDates($fields);
  query($pdo, $query, $fields);
}
// Updating Jokes
// function updateJoke($pdo, $jokeId, $joketext, $authorId) {
//   $parameters = [':joketext' => $joketext,
//   ':authorId' => $authorId, ':id' => $jokeId];
//   query($pdo, 'UPDATE `joke` SET `authorId` = :authorId,
//   `joketext` = :joketext WHERE `id` = :id', $parameters);
// }

function updateJoke($pdo, $fields) {
  $query = ' UPDATE `joke` SET ';
  foreach ($fields as $key => $value) {
  $query .= '`' . $key . '` = :' . $key . ',';
  }
  //same as UPDATE `joke` SET `id` = :id, `joketext` = :joketext WHERE `id` = :primaryKey
  $query = rtrim($query, ',');
  $query .= ' WHERE `id` = :primaryKey';
  //Automatic date formating
  $fields = processDates($fields);
  // Set the :primaryKey variable
  $fields['primaryKey'] = $fields['id'];
  query($pdo, $query, $fields);
}

//Deleting jokes

function deleteJoke($pdo, $id) {
  $parameters = [':id' => $id];
  query($pdo, 'DELETE FROM `joke`
  WHERE `id` = :id', $parameters);
}

function deleteAuthor($pdo, $id) {
  $parameters = [':id' => $id];
  query($pdo, 'DELETE FROM `author`
  WHERE `id` = :id', $parameters);
}


// Generic functions 

function findAll($pdo, $table) {
  $result = query($pdo, 'SELECT * FROM `' . $table . '`');
  return $result->fetchAll();
}

// // Select all the jokes from the database
// $allJokes = findAll($pdo, 'joke');
// // Select all the authors from the database
// $allAuthors = findAll($pdo, 'author');

function delete($pdo, $table, $primaryKey, $id ) {
  $parameters = [':id' => $id];
  query($pdo, 'DELETE FROM `' . $table . '`
  WHERE `' . $primaryKey . '` = :id', $parameters);
}

// delete($pdo, 'author', 'id', 2);
// // Delete joke with the id of 5
// delete($pdo, 'joke', 'id', 5);
// // Delete the book with the ISBN 978-3-16-148410-0
// delete($pdo, 'book', '978-3-16-148410-0', 'isbn');

function insert($pdo, $table, $fields) {
  $query = 'INSERT INTO `' . $table . '` (';
  foreach ($fields as $key => $value) {
    $query .= '`' . $key . '`,';
  }
  $query = rtrim($query, ',');
  $query .= ') VALUES (';
  foreach ($fields as $key => $value) {
    $query .= ':' . $key . ',';
  }
  $query = rtrim($query, ',');
  $query .= ')';
  $fields = processDates($fields);
  query($pdo, $query, $fields);
}

function update($pdo, $table, $primaryKey, $fields) {
  $query = ' UPDATE `' . $table .'` SET ';
  foreach ($fields as $key => $value) {
    $query .= '`' . $key . '` = :' . $key . ',';
  }
  $query = rtrim($query, ',');
  $query .= ' WHERE `' . $primaryKey . '` = :primaryKey';
  // Set the :primaryKey variable
  $fields['primaryKey'] = $fields['id'];
  $fields = processDates($fields);
  query($pdo, $query, $fields);
}

function findById($pdo, $table, $primaryKey, $value) {
  $query = 'SELECT * FROM `' . $table . '`
  WHERE `' . $primaryKey . '` = :value';
  $parameters = [
  'value' => $value
  ];
  $query = query($pdo, $query, $parameters);
  return $query->fetch();
}

function total($pdo, $table) {
  $query = query($pdo, 'SELECT COUNT(*)
  FROM `' . $table . '`');
  $row = $query->fetch();
  return $row[0];
}

function save($pdo, $table, $primaryKey, $record) {
  try {
  if ($record[$primaryKey] == '') {
    $record[$primaryKey] = null;
  }
  insert($pdo, $table, $record);
  }catch (PDOException $e) {
    update($pdo, $table, $primaryKey, $record);
  }
}