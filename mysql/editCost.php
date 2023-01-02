<?php 
require_once __DIR__ . "/../functions.php"; // підключення функцій
require_once __DIR__ . "/mysqlConnect.php"; // підключення до БД
require_once __DIR__ . "/../header.php"; // підключення хедеру

    if(isset($_GET['editId'])) { // Перевірка, чи переданий ID

    $editId = $_GET['editId']; // Записуємо ID у змінну
    $getTable = $mysqli->query("SELECT `category`, `name`, `price` FROM `stats_cost` WHERE `stats_cost`.`id` = '$editId'"); // Записуємо дані таблиці у змінну
    
    $product[] = $getTable->fetch_assoc(); // З таблиці беремо лише 1 рядок, тому без циклу записуємо його у змінну
    
    if (reset($product) == false) { // Перевіряємо, чи не прийшов пустий масив
    	redirect('../index.php'); // Якщо пустий - редіректимо на головну сторінку
    } else {
        $product = reset($product); // У змінній двомірний масив з 1 значенням, перезаписуємо його у змінну, щоб було легше звертатись
    }
?>

    <!-- Таблиця з рядком, який редагуємо -->

        <table align="center"> 
            <thead>
            <tr>
                <th class="text-center">Категорія</th>
                <th class="text-center">Назва</th>
                <th colspan="2" class="text-center">Ціна</th>
            </tr>
            </thead>
            <tr>
                <form method="post" name="edit">
                <td><input type="text" class="heighttext" name="category" value="<?=$product['category']?>"></td>
                <td><input type="text" class="heighttext" name="name" value="<?=$product['name']?>"></td>
                <td><input type="text" class="heighttext" name="price" value="<?=$product['price']?>"></td>
                <td><input type="submit" class="heighttext" value="Редагувати" name="edit"></td>
                </form>
            </tr>
        </table>

    <!-- Таблиця з рядком, який редагуємо -->
    
<?php

    if (isset($_POST['edit'])){ // Якщо натиснули кнопку "Редагувати"
        $category = $_POST['category'] ?? ''; // Перевіряємо category на пустоту
        $name = $_POST['name'] ?? 0; // Перевіряємо name на пустоту
        $price = $_POST['price'] ?? 0; // Перевіряємо price на пустоту

        $category = $mysqli->real_escape_string($category); // Екрануємо спеціальні символи category
        $name = $mysqli->real_escape_string($name); // Екрануємо спеціальні символи name
        $price = $mysqli->real_escape_string($price); // Екрануємо спеціальні символи price
        
        $mysqli->query("UPDATE `stats_cost` SET `category` = '$category', `name` = '$name', `price` = '$price' WHERE `stats_cost`.`id` = '$editId'");  // Оновлюємо дані в таблиці
        
        redirect('../index.php?table=cost'); // Редиректимо на головну сторінку
    }

    } else { // Якщо ID не переданий
        redirect('../index.php?table=cost'); // редиректимо на голвну сторінку
    } 
