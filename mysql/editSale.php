<?php 
require __DIR__ . "/../functions.php";
require __DIR__ . "/mysqlConnect.php";
require __DIR__ . "/../header.php";

    if(isset($_GET['editId'])) {

    $editId = $_GET['editId'];
    $getTable = $mysqli->query("SELECT `product`, `price`, `profit`, `remains` FROM `stats_sale` WHERE `stats_sale`.`id` = '$editId'");
    
    $product[] = $getTable->fetch_assoc();
    
    if (reset($product) == false) {
    	redirect('../index.php');
    } else {
        $product = reset($product);
    }
    
?>

    <div class="container">
        <table border="1" width="80%" align="center">
            <tr>
                <form method="post" name="edit">
                <td><input type="text" name="product" value="<?=$product['product']?>"></td>
                <td><input type="text" name="price" value="<?=$product['price']?>"></td>
                <td><input type="text" name="profit" value="<?=$product['profit']?>"></td>
                <td><input type="text" name="remains" value="<?=$product['remains']?>"></td>
                <td><input type="submit" value="Редагувати" name="edit"></td>
                </form>
            </tr>
        </table>
    </div>

<?php

    if (isset($_POST['edit'])){
        $product = !empty($_POST['product']) ? $_POST['product'] : '';
        $price = !empty($_POST['price']) ? $_POST['price'] : 0;
        $profit = !empty($_POST['profit']) ? $_POST['profit'] : 0;
        $remains = !empty($_POST['remains']) ? $_POST['remains'] : 0;

        $product = $mysqli->real_escape_string($product);
        $price = $mysqli->real_escape_string($price);
        $profit = $mysqli->real_escape_string($profit);
        $remains = $mysqli->real_escape_string($remains);
        
        $mysqli->query("UPDATE `stats_sale` SET `product` = '$product', `price` = '$price', `profit` = '$profit', `remains` = '$remains' WHERE `stats_sale`.`id` = '$editId'"); 
        
        redirect('../index.php');
    }

    } else {
        redirect('../index.php');
    } 
