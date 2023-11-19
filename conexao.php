<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', 'root');
define('DBNAME', 'test');

$conn = new mysqli('mysql:host=' . HOST . ';dbname=' . DBNAME . ';', USER, PASS);
?>