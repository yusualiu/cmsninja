<?php
if (isset($_POST['joketext']) && !empty($_POST['joketext'])) {
  try {
    include __DIR__ . '/includes/DatabaseConnection.php';
    include_once __DIR__ .'/includes/DatabaseFunctions.php';

    // prepare mysql server before sending the query
    // $sql = 'INSERT INTO `joke` SET
    // `joketext` = :joketext,
    // `jokedate` = CURDATE()';
    // $stmt = $pdo->prepare($sql);
    // $stmt->bindValue(':joketext', $_POST['joketext']);
    // $stmt->execute();
    // insertJoke($pdo,$_POST['joketext'], 2);
    insert($pdo, 'joke', ['authorId' => 1, 'jokeText' => $_POST['joketext'], 'jokedate' => new DateTime()]);
    // insertJoke($pdo, ['authorId' => 1,
    //       'jokeText' => $_POST['joketext'],
    //       'jokedate' => new DateTime()
    //       ]);
          
    header('location: jokes.php');// redirect to jokes page
    
  } catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in '
    . $e->getFile() . ':' . $e->getLine();
  }
} else {
  $title = 'Add a new joke';
  ob_start();
  include __DIR__ . '/templates/addjoke.html.php';
  $output = ob_get_clean();
} include __DIR__ .'/templates/layout.html.php';