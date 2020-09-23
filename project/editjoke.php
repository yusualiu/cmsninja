<?php
include_once __DIR__ . '/includes/DatabaseConnection.php';
include_once __DIR__ .'/includes/DatabaseFunctions.php';
  try {
    if (isset($_POST['joke'])) {
    // updateJoke($pdo, $_POST['jokeId'],$_POST['joketext'], 1);
    // updateJoke($pdo, [
    //   'id' => $_POST['jokeid'],
    //   'joketext' => $_POST['joketext'],
    //   'authorId' => 1 ]);

//       update($pdo, 'joke', 'id', ['id' => $_POST['jokeid'],
// 'joketext' => $_POST['joketext'],'authorId' => 1]);

// save($pdo, 'joke', 'id', ['id' => $_POST['jokeid'],'joketext' => $_POST['joketext'],'jokedate' => new DateTime(),
// 'authorId' => 1]);

$joke = $_POST['joke'];
$joke['jokedate'] = new DateTime();
$joke['authorId'] = 1;
  save($pdo, 'joke', 'id', $joke);
    header('location: jokes.php');// redirect to jokes page

    }else {
      $title = 'Add a new joke';
      // $joke = getJoke($pdo, $_GET['id']);
      if(isset($_GET['id'])){
        $title = 'Edit joke';
        $joke = findById($pdo, 'joke', 'id', $_GET['id']);
      }
      
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