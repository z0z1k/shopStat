<?php require __DIR__ . "/../functions.php";?>
<?php require __DIR__ . "/mysqlConnect.php";?>
<?php require __DIR__ . "/../header.php";?>
<?php
    if(isset($_GET['editId'])) {

    $editId = $_GET['editId'];
    $getTable = $mysqli->query("SELECT `product`, `price`, `profit`, `remains` FROM `stats_sale` WHERE `stats_sale`.`id` = '$editId'");
    $table = [];
    while (($row = $getTable->fetch_assoc()) != false) {
        $table[] = $row;
    }
    if (empty($table)) {
    	redirect('../index.php');
    }
    
    foreach ($table as $product) {
    ?>

    <form method="post" name="edit">
    <div class="container">
        <table border="1" width="80%" align="center">
            <tr>
                <td><input type="text" name="product" value="<?=$product['product'];?>"></td>
                <td><input type="text" name="price" value="<?=$product['price'];?>"></td>
                <td><input type="text" name="profit" value="<?=$product['profit'];?>"></td>
                <td><input type="text" name="remains" value="<?=$product['remains'];?>"></td>
            </tr>
        </table>
    </div>
        <p><input type="submit" value="Редагувати" name="edit"></p
    </form>
    <?php }

    if (isset($_POST['edit'])){
        $product = !empty($_POST['product']) ? $_POST['product'] : '';
        $price = !empty($_POST['price']) ? $_POST['price'] : 0;
        $profit = !empty($_POST['profit']) ? $_POST['profit'] : 0;
        $remains = !empty($_POST['remains']) ? $_POST['remains'] : 0;
        
        $mysqli->query("UPDATE `stats_sale` SET `product` = '$product', `price` = '$price', `profit` = '$profit', `remains` = '$remains' WHERE `stats_sale`.`id` = '$editId'"); 
        
        redirect('../index.php');
    }

    } else {
        redirect('../index.php');
    } 
