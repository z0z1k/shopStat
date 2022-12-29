<?php 
require __DIR__ . "/../functions.php";
require __DIR__ . "/mysqlConnect.php";
require __DIR__ . "/../header.php";

    if(isset($_GET['editId'])) {

    $editId = $_GET['editId'];
    $getTable = $mysqli->query("SELECT `category`, `name`, `price` FROM `stats_cost` WHERE `stats_cost`.`id` = '$editId'");
    $table = [];
    while (($row = $getTable->fetch_assoc()) != false) {
        $table[] = $row;
    }
    if (empty($table)) {
    	redirect('../index.php?table=cost');
    }
    
    foreach ($table as $product) {
    ?>

    <form method="post" name="edit">
    <div class="container">
        <table border="1" width="80%" align="center">
            <tr>
                <td><input type="text" name="category" value="<?=$product['category']?>"></td>
                <td><input type="text" name="name" value="<?=$product['name']?>"></td>
                <td><input type="text" name="price" value="<?=$product['price']?>"></td>
            </tr>
        </table>
    </div>
        <p><input type="submit" value="Редагувати" name="edit"></p
    </form>
    <?php }

    if (isset($_POST['edit'])){
        $category = !empty($_POST['category']) ? $_POST['category'] : '';
        $name = !empty($_POST['name']) ? $_POST['name'] : 0;
        $price = !empty($_POST['price']) ? $_POST['price'] : 0;

        $category = $mysqli->real_escape_string($category);
        $name = $mysqli->real_escape_string($name);
        $price = $mysqli->real_escape_string($price);
        
        $mysqli->query("UPDATE `stats_cost` SET `category` = '$category', `name` = '$name', `price` = '$price' WHERE `stats_cost`.`id` = '$editId'"); 
        
        redirect('../index.php?table=cost');
    }

    } else {
        redirect('../index.php?table=cost');
    } 
