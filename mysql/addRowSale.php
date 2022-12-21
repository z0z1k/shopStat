<?php require __DIR__ . "/mysqlConnect.php";?>
<?php require __DIR__ . "/../functions.php";?>
<?php
    
    if(isset($_POST['addProduct'])){

        $product = !empty($_POST['product']) ? $_POST['product'] : '';
        $price = !empty($_POST['price']) ? $_POST['price'] : 0;
        $profit = !empty($_POST['profit']) ? $_POST['profit'] : 0;
        $remains = !empty($_POST['remains']) ? $_POST['remains'] : 0;

        $mysqli->query("INSERT INTO `stats_sale` 
                    (`product`, `price`, `profit`, `remains`, `date`) 
                    VALUES ('$product', '$price', '$profit', '$remains', UNIX_TIMESTAMP())");
        redirect('../index.php');
        }
