<?php 
require __DIR__ . "/mysqlConnect.php";
require __DIR__ . "/../functions.php";
    
    if(isset($_POST['addProduct'])){

        $product = !empty($_POST['product']) ? $_POST['product'] : '';
        $price = !empty($_POST['price']) ? $_POST['price'] : 0;
        $profit = !empty($_POST['profit']) ? $_POST['profit'] : 0;
        $remains = !empty($_POST['remains']) ? $_POST['remains'] : 0;

        $product = $mysqli->real_escape_string($product);
        $price = $mysqli->real_escape_string($price);
        $profit = $mysqli->real_escape_string($profit);
        $remains = $mysqli->real_escape_string($remains);

        $mysqli->query("INSERT INTO `stats_sale` 
                    (`product`, `price`, `profit`, `remains`, `date`) 
                    VALUES ('$product', '$price', '$profit', '$remains', UNIX_TIMESTAMP())");
        redirect('../index.php');
        }
