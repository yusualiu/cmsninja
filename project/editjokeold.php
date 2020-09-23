<?php
include_once __DIR__ . '/includes/DatabaseConnection.php';
include_once __DIR__ .'/includes/DatabaseFunctions.php';
  try {
    if (isset($_POST['joketext']) && !empty($_POST['joketext'])) {
    // updateJoke($pdo, $_POST['jokeId'],$_POST['joketext'], 1);
    // updateJoke($pdo, [
    //   'id' => $_POST['jokeid'],
    //   'joketext' => $_POST['joketext'],
    //   'authorId' => 1 ]);
      update($pdo, 'joke', 'id', ['id' => $_POST['jokeid'],
'joketext' => $_POST['joketext'],'authorId' => 1]);
    header('location: jokes.php');// redirect to jokes page

    }else {
      $title = 'Add a new joke';
      // $joke = getJoke($pdo, $_GET['id']);
      $joke = findById($pdo, 'joke', 'id', $_GET['id']);
      ob_start();
      include __DIR__ . '/templates/editjoke.html.php';
      $output = ob_get_clean();
    }    
  } catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in '
    . $e->getFile() . ':' . $e->getLine();
  }
  include __DIR__ .'/templates/layout.html.php';