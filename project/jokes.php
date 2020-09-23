<?php
try {
  include_once __DIR__ . '/includes/DatabaseConnection.php';
  include_once __DIR__ .'/includes/DatabaseFunctions.php';

    // $sql = 'SELECT id,`joketext` FROM `joke`';
    // $sql = 'SELECT `joke`.`id`, `joketext`, `name`, `email`
    // FROM `joke` INNER JOIN `author`
    // ON `authorid` = `author`.`id` WHERE `name` = "Tom Butler"';// joining two tables 
    //  $sql = 'SELECT `joke`.`id`, `joketext`, `name`, `email`
    //  FROM `joke` INNER JOIN `author`
    //  ON `authorid` = `author`.`id`';
    // $sql = 'SELECT m.`id`, `joketext`, `name`, `email`
    //  FROM `joke` m,`author`a
    //  where `authorid` != `a`.`id` and authorid=2' ;


// select m.* from items m ,item_usernotifications mu where m.id != mu.item_id and mu.user_id = 3 @twitter
   
    // $jokes = $pdo->query($sql);// $jokes = allJokes($pdo);
    // $jokes = allJokes($pdo);
    // $totalJokes = totalJokes($pdo);
    // updateJoke($pdo, 1, '!false - It\'s funny because it\'s true', 1);

//     $query = $pdo->prepare('UPDATE `joke`
// SET `authorId` = :authorId, `joketext` = :joketext
// WHERE id = :id');
// $query->bindValue(':id', 1);
// $query->bindValue(':authorId', 1);
// $query->bindValue(':joketext', '!false - It\'s funny because it\'s true');
// $query->execute();
  $result = findAll($pdo, 'joke');
  $jokes = [];
  foreach ($result as $joke) {
    $author = findById($pdo, 'author', 'id',2);
    // $author = findById($pdo, 'author', 'id',$joke['authorId']);
    $jokes[] = [
      'id' => $joke['id'],
      'joketext' => $joke['joketext'],
      'jokedate' => $joke['jokedate'],
      'name' => $author['name'],
      'email' => $author['email']
    ];
  }
  
  $totalJokes = total($pdo, 'joke'); 
    $title = 'Joke list';
    ob_start();// preventing printing of html on screen with output buffering.
   
    include __DIR__ . '/templates/jokes.html.php';

    $output = ob_get_clean();


} catch (PDOException $e) {
  $title = 'An error has occurred';
  $output = 'Database error: ' . $e->getMessage() . ' in ' .$e->getFile() . ':' . $e->getLine();
  
}
include __DIR__ . '/templates/layout.html.php';