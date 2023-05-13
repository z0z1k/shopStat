<?php 
//require_once __DIR__ . "/../functions.php"; // підключення функцій
//require_once __DIR__ . "/mysqlConnect.php"; // підключення до БД
require_once __DIR__ . "/../header.php"; // підключення хедеру
include __DIR__ . "/../model/db.php";

    if(isset($_GET['editId'])) { // Перевірка, чи переданий ID

    $editId = $_GET['editId']; // Записуємо номер у змінну

    $sql = "SELECT `product`, `price`, `profit`, `remains` FROM `stats_sale` WHERE `stats_sale`.`id` = '$editId'";
    $query = dbQuery($sql);
    $product = $query->fetch();

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

        $params = [
            'product' => $product,
            'price' => $price,
            'profit' => $profit,
            'remains' => $remains
        ];

        $sql = "UPDATE `stats_sale` SET `product` = :product, `price` = :price, `profit` = :profit, `remains` = :remains WHERE `stats_sale`.`id` = '$editId'";

        dbQuery($sql, $params);

    }

    } else { // Якщо ID не переданий
        redirect('../index.php'); // редиректимо на головну сторінку
    } 
