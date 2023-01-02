<?php 
require __DIR__ . "/mysqlConnect.php"; // підключення до БД
require __DIR__ . "/../functions.php"; // підключення функцій
    
    if(isset($_POST['addProduct'])){ // Якщо натиснута кнопка "Додати"

        $product = $_POST['product'] ?? ''; // Перевіряємо product на пустоту
        $price = $_POST['price'] ?? 0; // Перевіряємо price на пустоту
        $profit = $_POST['profit'] ?? 0; // Перевіряємо profit на пустоту
        $remains = $_POST['remains'] ?? 0; // Перевіряємо remains на пустоту

        $product = $mysqli->real_escape_string($product); // Екрануємо спеціальні символи product
        $price = $mysqli->real_escape_string($price); // Екрануємо спеціальні символи price
        $profit = $mysqli->real_escape_string($profit); // Екрануємо спеціальні символи profit
        $remains = $mysqli->real_escape_string($remains); // Екрануємо спеціальні символи remains

        $mysqli->query("INSERT INTO `stats_sale` 
                    (`product`, `price`, `profit`, `remains`, `date`) 
                    VALUES ('$product', '$price', '$profit', '$remains', UNIX_TIMESTAMP())"); // Додаємо дані в таблицю
        redirect('../index.php'); // Редиректимо на головну сторінку
        }
