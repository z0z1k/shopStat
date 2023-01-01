<?php 
require __DIR__ . "/../functions.php";
require __DIR__ . "/mysqlConnect.php";
require __DIR__ . "/../header.php";

    if(isset($_GET['editId'])) {

    $editId = $_GET['editId'];
    $getTable = $mysqli->query("SELECT `category`, `name`, `price` FROM `stats_cost` WHERE `stats_cost`.`id` = '$editId'");
    
    $product[] = $getTable->fetch_assoc();
    
    if (reset($product) == false) {
    	redirect('../index.php');
    } else {
        $product = reset($product);
    }
?>
        <table> 
            <thead>
            <tr>
                <th>Категорія</th>
                <th>Назва</th>
                <th colspan="2">Ціна</th>
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
    
<?php

    if (isset($_POST['edit'])){
        $category = $_POST['category'] ?? '';
        $name = $_POST['name'] ?? 0;
        $price = $_POST['price'] ?? 0;

        $category = $mysqli->real_escape_string($category);
        $name = $mysqli->real_escape_string($name);
        $price = $mysqli->real_escape_string($price);
        
        $mysqli->query("UPDATE `stats_cost` SET `category` = '$category', `name` = '$name', `price` = '$price' WHERE `stats_cost`.`id` = '$editId'"); 
        
        redirect('../index.php?table=cost');
    }

    } else {
        redirect('../index.php?table=cost');
    } 
