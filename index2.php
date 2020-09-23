<?php
include 'connection.php';
// if (!isset($_POST['firstname'])) {
//   include __DIR__ . '/../templates/form.html.php';
// } else {
//     $firstName = $_POST['firstname'];
//     $lastName = $_POST['lastname'];
//     if ($firstName == 'Kevin' && $lastName == 'Yank') {
//     $output = 'Welcome, oh glorious leader!';
//     } else {
//     $output = 'Welcome to our website, ' .
//     htmlspecialchars($firstName, ENT_QUOTES, 'UTF-8') . ' ' .
//     htmlspecialchars($lastName, ENT_QUOTES, 'UTF-8') . '!';
//     }
//     include __DIR__ . '/../templates/welcome.html.php';
// }

try {
  $pdo = new PDO('mysql:host=localhost;dbname=foundation;charset=utf8','root','');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // $output = 'Database connection established.';

  // $sql = 'CREATE TABLE joke (
  //   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  //   joketext TEXT,
  //   jokedate DATE NOT NULL
  //   ) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB';
  //   $pdo->exec($sql);
  //   $output = 'Joke table successfully created.';// table already exists

  // $sql = 'UPDATE joke SET jokedate="2020-08-01"
  // WHERE joketext LIKE "%funny%"';
  // $affectedRows = $pdo->exec($sql); // returns zero if no affected rows
  // $output = 'Updated ' . $affectedRows .' rows.'; update,delete, and insert.

  // Handling SELECT Result Sets

  $sql = 'SELECT `joketext` FROM `joke`';
$result = $pdo->query($sql);//returns PDOStatement object.
  while($row = $result->fetch()){
    $jokes[] = $row['joketext'];
  }
  // or
  // foreach ($result as $row) {
  //   $jokes[] = $row['joketext'];
  //   }
  
  } catch (PDOException $e) {

//     $output = 'Unable to connect to the database server: ' .
// $e->getMessage() . ' in ' .
// $e->getFile() . ':' . $e->getLine(); //for debugging purposes
  $output = 'Unable to connect to the database server: ' . $e;
  }

  include __DIR__ . '/../templates/jokes.html.php';

  $pdo = null; // disconnect from the database server