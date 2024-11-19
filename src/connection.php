<?php

    //Establishes connection to the database with name simon
    
$dsn = 'mysql:host=localhost;port=3306;dbname=promptbook';
$username = 'bit_academy';
$password = 'bit_academy';

$dbh = new PDO($dsn, $username, $password);

?>