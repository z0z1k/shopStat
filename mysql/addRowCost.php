<?php 
require __DIR__ . "/mysqlConnect.php"; // підключення до БД
require __DIR__ . "/../functions.php"; // підключення функцій
    
    if(isset($_POST['addProduct'])){ // Якщо натиснута кнопка "Додати"

        $category = $_POST['category'] ?? ''; // Перевіряємо category на пустоту
        $name = $_POST['name'] ?? 0; // Перевіряємо name на пустоту
        $price = $_POST['price'] ?? 0; // Перевіряємо price на пустоту

        $category = $mysqli->real_escape_string($category); // Екрануємо спеціальні символи category
        $name = $mysqli->real_escape_string($name); // Екрануємо спеціальні символи name
        $price = $mysqli->real_escape_string($price); // Екрануємо спеціальні символи price

        $mysqli->query("INSERT INTO `stats_cost` 
                    (`category`, `name`, `price`, `date`) 
                    VALUES ('$category', '$name', '$price', UNIX_TIMESTAMP())"); // Додаємо дані в таблицю
        redirect('../index.php?table=cost'); // Редиректимо на головну сторінку
        }
