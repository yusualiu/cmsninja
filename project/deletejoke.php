<?php

  try {
    include_once __DIR__ . '/includes/DatabaseConnection.php';
include_once __DIR__ .'/includes/DatabaseFunctions.php';

    // prepare mysql server before sending the query
    
  // deleteJoke($pdo, $_POST['id']);
  delete($pdo, 'joke', 'id', $_POST['id']);
    header('location: jokes.php');// redirect to jokes page
  } catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in '
    . $e->getFile() . ':' . $e->getLine();
  }
