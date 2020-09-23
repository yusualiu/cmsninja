<?php
$output = '';
for ($count = 1; $count <= 10; $count++) {
$output .= $count . ' ';
}

 include __DIR__.'/../count.html.php'; // locate public(current working dir.), go outside of public in one step and locate   count.html.php.
