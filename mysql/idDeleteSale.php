<?php 
require __DIR__ . "/mysqlConnect.php"; // підключення до БД
require_once __DIR__ . "/../functions.php"; // підключення функцій

    if(isset($_POST['idDelete'])) { // Якщо натиснута кнопка "Видалити"
        foreach($_POST['idDelete'] as $delete) { // Для кожного вибраного ID
            $mysqli->query("DELETE FROM `stats_sale` WHERE `stats_sale`.`id` = '$delete'"); // видаляємо рядок з таблиці
        }
    }
    redirect('../index.php'); // Редиректимо на головну сторінку