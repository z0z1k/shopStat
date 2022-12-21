<?php

define("HOST", 'localhost');
define("USER", "testUser");
define("PASSWORD", "PpjoN4pAZGylF_Lj");
define("DBNAME", "stats");

$mysqli =@new mysqli(HOST, USER, PASSWORD, DBNAME);
if ($mysqli->connect_errno) exit ("Помилка з'єднання з БД");
$mysqli->set_charset('utf8');
