<?php
require __DIR__ . "/header.php";
require_once __DIR__ . "/mysql/getTable.php";
require_once __DIR__ . "/functions.php";
?>

<div class="container">
<table class="container">

<?php if (isCost()) { ?>
    <form method="post" action="mysql/idDeleteCost.php" name="checkBox">
<?php } else { ?>
    <form method="post" action="mysql/idDeleteSale.php" name="checkBox">
<?php } ?>

<thead>   
    <tr>
    <?php if (isCost()) { ?>
        <th><input type="submit" name="checkBox" value="Видалити"></th>
        <th>Категорія</th>
        <th>Назва</th>
        <th>Ціна</th>
        <th></th>
        <th>Час</th>
    <?php } else { ?>
        <th><input type="submit" name="checkBox" value="Видалити"></th>
        <th>Товар</th>
        <th>Продажа</th>
        <th>Чисті</th>
        <th>Залишок</th>
        <th>Час</th>
    <?php } ?>
    </tr>
</thead>

<tbody>
    <?php foreach ($table as $product) { ?>
    <tr>
    <?php if (isCost()) { ?>
        <td>
            <input type="checkbox" name="idDelete[]" value="<?=$product['id']?>">
            <a href="mysql/editCost.php?editId=<?=$product['id']?>"><img src="img/edit.png" width="20px"></a>
        </td>
        <td><?=$product['category']?></td>
        <td><?=$product['name']?></td>
        <td><?=$product['price']?></td>
        <td></td>
        <td><?=date('G:i:s', $product['date'])?></td>
    <?php } else { ?>
        <td>
            <input type="checkbox" name="idDelete[]" value="<?=$product['id']?>">
            <a href="mysql/editSale.php?editId=<?=$product['id']?>"><img src="img/edit.png" width="20px"></a>
        </td>
        <td><?=$product['product']?></td>
        <td><?=$product['price']?></td>
        <td><?=$product['profit']?>
        </td>
        <td><?=$product['remains']?></td>
        <td><?=date('G:i:s', $product['date'])?></td>
    <?php } ?>
    </tr>
    <?php } ?>

    <tr>
        <td>
            <a href="?table=sale&">Доходи</a>
            <br />
            <a href="?table=cost&">Витрати</a>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>

    </form> 
    <tr>
    <?php if (isCost()) { ?>    
        <td>
        </td>
    <form method="post" action="mysql/addRowCost.php" name="addProduct">
        <td><input type="text" name="category"></td>
        <td><input type="text" name="name"></td>
        <td><input type="text" name="price"></td>
        <td></td>
        <td><input type="submit" value="Додати" name="addProduct"></td>
    </form>
    <?php } else {?>
        <td>
        </td>
        <form method="post" action="mysql/addRowSale.php" name="addProduct">
        <td><input type="text" name="product"></td>
        <td><input type="text" name="price"></td>
        <td><input type="text" name="profit"></td>
        <td><input type="text" name="remains"></td>
        <td><input type="submit" value="Додати" name="addProduct"></td>
    </form>
    </tr>
    <?php } ?>

    <tr>
        <td colspan="6">
            <form name="setDate" method="post">
                За <input type="date" name="setStartDate" value="<?=date('Y-m-d', $dateStart)?>">
                <input type="submit" value="setDate" name="setDateBTN"> сума чистих <?=$sumProfit?>, витрати <?=$sumCost?>, загальний дохід <?=$sumProfit - $sumCost?>
        </td>
    </tr>

    <tr>
        <td colspan="6">
            <?php if (isset($_GET['date']) && $_GET['date'] == 'period' || $dateEnd - $dateStart >= 86400) { ?>
                <input type="date" name="setEndDate" value="<?=date('Y-m-d', $dateEnd)?>">
                <input type="submit" value="Обрати 1 день" name="deleteEndDate">
                </form>
            <?php } else { 
                if (isset($_GET['table'])) { ?>
                    <a href="<?=$_SERVER['REQUEST_URI'] . 'date=period&'?>">Вибрати період</a>
                <?php } else { ?>
                    <a href="<?=$_SERVER['REQUEST_URI'] . '?date=period&'?>">Вибрати період</a>
                <?php } ?>
            <?php } ?>
        </td>
    </tr>
</tbody>

</table>
</div>

<?php var_dump($_POST) ?>
<?php require __DIR__ . "/footer.php" ?>
