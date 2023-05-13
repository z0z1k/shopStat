<?php

define("HOST", 'z0z1k.mysql.tools');
define("USER", "z0z1k_stats");
define("PASSWORD", ")~X7z9zi3R");
define("DBNAME", "z0z1k_stats");

$mysqli =@new mysqli(HOST, USER, PASSWORD, DBNAME);
if ($mysqli->connect_errno) exit ("Помилка з'єднання з БД");
$mysqli->set_charset('utf8');
