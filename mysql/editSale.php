<?php 
require_once __DIR__ . "/../functions.php"; // підключення функцій
require_once __DIR__ . "/mysqlConnect.php"; // підключення до БД
require_once __DIR__ . "/../header.php"; // підключення хедеру

    if(isset($_GET['editId'])) { // Перевірка, чи переданий ID

    $editId = $_GET['editId']; // Записуємо номер у змінну
    $getTable = $mysqli->query("SELECT `product`, `price`, `profit`, `remains` FROM `stats_sale` WHERE `stats_sale`.`id` = '$editId'"); // Записуємо дані таблиці у змінну
    
    $product[] = $getTable->fetch_assoc(); // З таблиці беремо лише 1 рядок, тому без циклу записуємо його у змінну
    
    if (reset($product) == false) { // Перевіряємо, чи не прийшов пустий масив
    	redirect('../index.php'); // Якщо пустий - редіректимо на головну сторінку
    } else {
        $product = reset($product); // У змінній двомірний масив з 1 значенням, перезаписуємо його у змінну, щоб було легше звертатись
    }
    
?>
    <!-- Таблиця з рядком, який редагуємо -->

        <table border="0" align="center">
            <thead>
            <tr>
                <th class="text-center">Товар</th> <!-- Товар -->
                <th class="text-center">Продажа</th> <!-- Продажа -->
                <th class="text-right">Чисті</th> <!-- Чисті -->
                <th colspan = "2" class="text-center">Залишок</th> <!-- Залишок -->
            </tr>
            </thead>
            <tr>
                <form method="post" name="edit">
                <td><input type="text" name="product" value="<?=$product['product']?>"></td> <!-- Товар -->
                <td><input type="text" name="price" value="<?=$product['price']?>"></td> <!-- Продажа -->
                <td><input type="text" name="profit" value="<?=$product['profit']?>"></td> <!-- Чисті -->
                <td><input type="text" name="remains" value="<?=$product['remains']?>"></td> <!-- Залишок -->
                <td><input type="submit" value="Редагувати" name="edit"></td> <!-- Кнопка "Редагувати" -->
                </form>
            </tr>
        </table>

    <!-- Кінець таблиці -->

<?php

    if (isset($_POST['edit'])){ // Якщо натиснули кнопку "Редагувати"
        $product = $_POST['product'] ?? ''; // Перевіряємо product на пустоту
        $price = $_POST['price'] ?? 0; // Перевіряємо price на пустоту
        $profit = $_POST['profit'] ?? 0; // Перевіряємо profit на пустоту
        $remains = $_POST['remains'] ?? 0; // Перевіряємо remains на пустоту

        $product = $mysqli->real_escape_string($product); // Екрануємо спеціальні символи product
        $price = $mysqli->real_escape_string($price); // Екрануємо спеціальні символи price
        $profit = $mysqli->real_escape_string($profit); // Екрануємо спеціальні символи profit
        $remains = $mysqli->real_escape_string($remains); // Екрануємо спеціальні символи remains
        
        $mysqli->query("UPDATE `stats_sale` SET `product` = '$product', `price` = '$price', `profit` = '$profit', `remains` = '$remains' WHERE `stats_sale`.`id` = '$editId'"); // Оновлюємо дані в таблиці
        
        redirect('../index.php'); // Редиректимо на головну сторінку
    }

    } else { // Якщо ID не переданий
        redirect('../index.php'); // редиректимо на головну сторінку
    } 
