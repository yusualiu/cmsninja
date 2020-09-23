<?php
include_once __DIR__ .'/includes/DatabaseConnection.php';
include_once __DIR__ .'/classes/DatabaseTable.php';
$title='Internet Joke Database';
ob_start();
include __DIR__ . '/templates/home.html.php';

$output =ob_get_clean();

//Using OOP
// $jokesTable = new DatabaseTable();
// $jokesTable->pdo = $pdo;
// $jokesTable->table = 'joke';
// $jokesTable->primaryKey = 'id';

// $jokes = $jokesTable->findAll();
// foreach($jokes as $joke){
//   echo $joke['joketext'];
// }
// echo totalJokes($pdo);// using main script variable in function scope dependency injection
include __DIR__ . '/templates/layout.html.php';