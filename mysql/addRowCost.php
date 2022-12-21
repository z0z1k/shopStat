<?php require __DIR__ . "/mysqlConnect.php";?>
<?php require __DIR__ . "/../functions.php";?>
<?php
    
    if(isset($_POST['addProduct'])){

        $category = !empty($_POST['category']) ? $_POST['category'] : '';
        $name = !empty($_POST['name']) ? $_POST['name'] : 0;
        $price = !empty($_POST['price']) ? $_POST['price'] : 0;

        $mysqli->query("INSERT INTO `stats_cost` 
                    (`category`, `name`, `price`, `date`) 
                    VALUES ('$category', '$name', '$price', UNIX_TIMESTAMP())");
        redirect('../index.php?table=cost');
        }
