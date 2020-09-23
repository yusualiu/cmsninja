<?php
// echo rand(1, 10);
// echo 'This is a <strong>test</strong>!';

// / $roll = rand(1, 6);
// echo '<p>You rolled a ' . $roll . '</p>';
// if ($roll == 6) {
// echo '<p>You win!</p>';
// } else {
// echo '<p>Sorry, you didn\'t win, better luck next time!</p>';
// }
// echo '<p>Thanks for playing</p>';



// for ($count = 1; $count <= 10; $count++) {
//   echo $count . ' ';
// }

// while ($count <= 10) {
//   echo $count . ' ';
//   ++$count;
//   }

// do {
//   statement(s) to execute and then repeat if the condition is true
//   } while (
//   condition);

// $myArray = ['one', 2, '3'];

// echo $myArray[0]; // outputs 'one'
// echo $myArray[1]; // outputs '2'
// echo $myArray[2]; // outputs '3'


// $myArray[] = 'five';
// $myArray[] = 'six';
// echo count($myArray);
// print_r($myArray);

// $english = [
//   1 => 'one',
//   2 => 'two',
//   3 => 'three',
//   4 => 'four',
//   5 => 'five',
//   6 => 'six'
//   ];
//   $roll1 = rand(1, 6);
//   $roll2 = rand(1, 6);
//   echo '<p>You rolled a <strong>' . $english[$roll1] . '</strong> and
//   a <strong>' . $english[$roll2] . '</strong></p>';

// an associative array.
// $birthdays = [
//   'Kevin' => '1978-04-12',
//   'Stephanie' => '1980-05-16',
//   'David' => '1983-09-09'
//   ];

//   echo 'Kevin\'s birthday is: ' . $birthdays['Kevin'];

// User Interaction and Forms e.g search form.

// Passing Variables in Links
// The simplest way to send information along with a page request is to use the URL query string

// <a href="name.php?name=Kevin">Hi, I&rsquo;m Kevin!</a>

//htmlspecialchars($name, ENT_QUOTES, 'UTF-8')// sanitize user data

// UTF-8 is one of many standards for representing text as a series of ones and zeros in computer
//  memory, called character encodings.

// As a rule of thumb, you should only use GET forms if, when the form is submitted, nothing on
// the server changes—such as when you’re requesting a list of search results.

// PHP Templates
// an HTML page with only very small snippets of
// PHP code that insert dynamically generated values into an otherwise static HTML page.

// Security Concerns
// It’s better not to let people run code in a manner you’re not expecting.

// The current working directory. echo __DIR__;
// The current working directory is set at the start of the script and applies to all the include
// statements, regardless of what file they are in.


/*
The public directory will contain any PHP scripts the
user needs to access directly along with any images, JavaScript and CSS files required by the
browser. Any files only referenced by an include statement will be placed outside the public
directory so users can’t access them directly.
*/
// Many Templates, One Controller
/*
A PHP script that responds to a browser request by selecting one of several PHP templates to fill
in and send back is commonly called a controller. A controller contains the logic that controls
which template is sent to the browser.
*/

// Directory index. 
// If you don’t specify a filename when you visit the URL in your browser, the server will
// look for a file named index.php and display that.

// isset(), isset($_POST['firstname'])
//Web server can host lots of different websites.
// MySQL is a database server and can host lots of different databases(schemas)

//Creating table
/*
CREATE TABLE `ijdb`.`joke` (
`id` INT NOT NULL AUTO_INCREMENT,
`joketext` TEXT NULL,
`jokedate` DATE NULL,
PRIMARY KEY (`id`));
*/

/*
Adding data to table
INSERT INTO tableName
(column1Name, column2Name, …)
VALUES (column1Value, column2Value, …)
INSERT INTO `author` (`id`, `name`, `email`)
VALUES (2, 'Tom Butler', 'tom@r.je');
*/
// Viewing Stored Data
// The command that we use to view data stored in database tables is SELECT.
// SELECT COUNT(`id`) FROM `joke` better than count(*)
// SELECT `id`, LEFT(`joketext`, 20), `jokedate` FROM `joke`
// SELECT `joketext` FROM `joke` WHERE `joketext` LIKE "%programmer%"

// Modifying Stored Data

// UPDATE `tableName` SET
// `colName` = newValue, …
// WHERE conditions

//deleting data
// DELETE FROM `tableName` WHERE conditions

// Users account on mysql server
// You could connect to the database from your PHP script using the same username (homestead)
// and password (secret), but it’s useful to create a new account—because if you have a web server,
// you may want to use it to host more than one website.

// throw a PHP exception

// try {
//   ⋮ do something risky
// } catch (
//   ExceptionType $
//   e) {
//   ⋮ handle the exception
// }


// PHP does have a useful feature called “output buffering”.
// By making use of output buffering,
// instead of having the output being sent straight to the browser, the HTML code is stored on the
// server in a “buffer”, which is basically just a string containing everything that’s been printed so
// far.

// ob_start(), which starts the output buffer. After calling this function, anything printed via
// echo or HTML printed via include will be stored in a buffer rather than sent to the browser.

// ob_get_clean(), which returns the contents of the buffer and clears it.


// ob_start();

// echo 'Helloworld';

// ob_get_clean();

// If a malicious user were to type
// some nasty SQL code into the form, this script would feed it to your MySQL server without
// question. This type of attack is called an SQL injection attack,

// prepared statements.

// A prepared statement is a special kind of SQL query that you’ve sent to your database server
// ahead of time, giving the server a chance to prepare it for execution—but not actually execute it.

// $stmt = $pdo->prepare($sql);
//     $stmt->bindValue(':joketext', $_POST['joketext']);
//     $stmt->execute();

    
// Don’t Use Hyperlinks to Perform Actions

// In short, hyperlinks should never be used to perform actions (such as deleting a joke); they must
// only be used to provide a link to some related content. The same goes for forms with
// method="get", which should only be used to perform queries of existing data. Actions must only
// ever be performed as a result of a form with method="post" being submitted.

// SQL Queries fall into two categories
// DDL(create table,alter table,create database)
// DML(select,insert,update,delete);

// one-to-one relationship
// An example of a one-to-one relationship is the email address of each author in our joke database.

// A many-to-one relationship
// Each joke in our database is associated with just(belongs to ) one author, but many jokes may have
// been written by that one author.

// Many-to-many Relationships
// A single joke might belong to many categories, and each category will contain
// many jokes. This is a many-to-many relationship.

// if you need to store multiple values in a single field, your design is probably flawed
// The correct way to represent a many-to-many relationship is by using a lookup table.
// This is a table that contains no actual data, but lists pairs of entries that are related.

// What we want to prevent is the same pair of values appearing in the table twice.
// For this reason, we usually create lookup tables with a multicolumn primary key as follows:
// CREATE TABLE `jokecategory` (
//   `jokeid` INT NOT NULL,
//   `categoryid` INT NOT NULL,
//   PRIMARY KEY (`jokeid`, `categoryid`)
//   ) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB

// This query lists all jokes in the knock-knock category:

// SELECT `joketext`
// FROM `joke`
// INNER JOIN `jokecategory`
// ON `joke`.`id` = `jokeid`
// INNER JOIN `category`
// ON `categoryid` = `category`.`id`
// WHERE name = "knock-knock"

// lists the names of all authors who have written knock-knock jokes

// SELECT `author`.`name`
// FROM `joke`
// INNER JOIN `author`
// ON `authorid` = `author`.`id`
// INNER JOIN `jokecategory`
// ON `joke`.`id` = `jokeid`
// INNER JOIN `category`
// ON `categoryid` = `category`.`id`
// WHERE `category`.`name` = "knock-knock"

// Structured PHP Programming

// Include files are the simplest way to structure PHP code. Because of their simplicity, they’re also
// the most widely used method. Even very simple web applications can benefit greatly from using
// include files.


// include
// require

// include_once
// require_once

// With include, a warning is displayed and the script continues to run. With require, an error is displayed
// and the script stops
// I do recommend using include whenever possible,however.

// Custom Functions and Function Libraries

// You can use PHP’s vast library of functions to
// do just about anything a PHP script could ever be asked to do, from retrieving the current date
// (date) to generating graphics on the fly (using imagecreatetruecolor).

// a return statement

// When the PHP interpreter hits a return statement, it immediately stops running the
// code of this function and goes back to where the function was called.
// In addition to breaking out of the function, the return statement lets you specify a value for the
// function to return to the code that called it.

// You can think of writing a function like installing an app on your computer or phone. You need
// it there to use it, but once installed, it’s dormant and available for use, but won’t actually do
// anything until you run it.

// To use the function in the include file, a PHP script need only include it with
// include_once (or require_once if the function is critical to the script).

// Avoid using include or require to load include files that contain functions.

// Variable Scope
// One big difference between custom functions and include files(library of functions) is the concept of variable scope.

// Unintentionally overwriting one of the main script’s variables in an include file is a common cause of error—and
// one that can take a long time to track down and fix!

// function scope

// Functions protect you from such problems. Variables created inside a function (including any
// argument variables) exist only within that function, and disappear when the function has run its
// course. In addition, variables created outside the function are completely inaccessible inside it.
// The only variables a function has access to are the ones provided to it as arguments.

// global scope 
// In contrast, variables created in the main script outside of any function are unavailable
// inside functions. The scope of these variables is the main script, and they’re said to have global
// scope.

// Global variables are a very bad idea and lead to problems that are very difficult to track down and fix.
// You should avoid global variables at any cost.

// Dependency injection
// it’s a method for making a single variable available in multiple locations.

// Breaking Up Your Code Into Reusable Functions
// Using Functions to Replace Queries

// Writing Functions

// When you write a function, it’s usually easier to write some examples of how you think it should
// be called before writing the code inside the function itself. This gives you a target to work
// towards, and some code you can run to see whether it’s working correctly or not.

// Handling Dates

// $date = new DateTime();
// echo $date->format('d/m/Y H:i:s');
// $date = new DateTime('5th March 2019');
// echo $date->format('d/m/Y');
// For Mysql
// $date = new DateTime();
// echo $date->format('Y-m-d H:i:s');$date->format('jS F Y');

// Making Your Own Tools

// Write functions that can be used over and over again on any website, rather than functions that only apply to a very specific case on a single website
// Generic Functions

// Repeated Code Is the Enemy

// If you ever find yourself in a situation like this, where you have to make similar changes in
// multiple files, it’s a good sign that you should combine both sets of code into one. Of course, the
// new code needs to handle both cases.

// Null coalescing operator
// if (isset($something)) {
//   echo $something;
//   } else {
//   echo 'variable not set';
//   }// same as echo $something ?? 'variable not set';

// Objects and Classes

// You can think of a class as a collection of functions and data (variables). Each class will contain
// a set of functions and some data that the functions can access.

// Naming Your Class Files
// Methods
// A function that exists inside a class is called a method.

// You can think of this as “this class”.

// The $this variable is created automatically inside any
// method and will always exist without being declared.

// Public vs Private

// These are known as visibility, allowing the programmer to determine
// where the method can be called from.

// Methods marked private can only be called from other methods inside the class, whereas
// methods marked public can be called from both inside and outside the class.

// Objects
// An object is an instance of a class.
// The new keyword creates an object from the defined class, which can then be used.

// Class Variables

// the goal of using objects and classes was to reduce repeated code.

// Rather than supply these values every time a method is called, you supply them once,
// to the class, and have the values used within the methods.

// Every class can have variables that are available to be used within any method. To declare a
// variable that will be used inside the class, you need to declare the variable within the class.

// An important distinction between class variables and normal variables is that they’re bound to a
// specific instance

// Constructors