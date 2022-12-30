<?php 
require __DIR__ . "/mysqlConnect.php";
require __DIR__ . "/../functions.php";
    
    if(isset($_POST['addProduct'])){

        $category = $_POST['category'] ?? '';
        $name = $_POST['name'] ?? 0;
        $price = $_POST['price'] ?? 0;

        $category = $mysqli->real_escape_string($category);
        $name = $mysqli->real_escape_string($name);
        $price = $mysqli->real_escape_string($price);

        $mysqli->query("INSERT INTO `stats_cost` 
                    (`category`, `name`, `price`, `date`) 
                    VALUES ('$category', '$name', '$price', UNIX_TIMESTAMP())");
        redirect('../index.php?table=cost');
        }
