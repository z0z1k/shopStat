<?php
require __DIR__ . "/header.php";
require_once __DIR__ . "/mysql/getTable.php";
require_once __DIR__ . "/functions.php";
?>

<table class="table-fill">

<!-- Створення форми для видалення -->

<?php if (isCost()) { ?>
    <form method="post" action="mysql/idDeleteCost.php" name="checkBox"> <!-- витрати -->
<?php } else { ?>
    <form method="post" action="mysql/idDeleteSale.php" name="checkBox"> <!-- доходи -->
<?php } ?>

<!-- -->

<!-- Шапка таблиці -->

<thead>   
    <tr>
    <th><button type="submit" name="checkBox" value="Видалити"><img class="icon" src="img/deleteIcon.png"></th> <!-- Кнопка видалення -->
    <?php if (isCost()) { ?>
        <th>Категорія</th>
        <th>Назва</th>
        <th>Ціна</th>
        <th>Час</th>
    <?php } else { ?>
        <th>Товар</th>
        <th>Продажа</th>
        <th>Чисті</th>
        <th>Залишок</th>
        <th>Час</th>
    <?php } ?>
    </tr>
</thead>

<!-- Кінець шапки -->

<tbody>
    <?php foreach ($table as $product) { ?>
    <tr>
    <?php if (isCost()) { ?>
        <td>
            <input type="checkbox" name="idDelete[]" value="<?=$product['id']?>">
            <a href="mysql/editCost.php?editId=<?=$product['id']?>"><img src="img/editIcon.png" class="icon"></a>
        </td>
        <td><?=$product['category']?></td>
        <td><?=$product['name']?></td>
        <td><?=$product['price']?></td>
        <td><?=date(timeFormat(), $product['date'])?></td>
    <?php } else { ?>
        <td>
            <input type="checkbox" name="idDelete[]" value="<?=$product['id']?>">
            <a href="mysql/editSale.php?editId=<?=$product['id']?>"><img src="img/editIcon.png" class="icon"></a>
        </td>
        <td><?=$product['product']?></td>
        <td><?=$product['price']?></td>
        <td><?=$product['profit']?></td>
        <td><?=$product['remains']?></td>
        <td><?=date(timeFormat(), $product['date'])?></td>
    <?php } ?>
    </tr>
    <?php } ?>
    </form> 
    <tr>
        <td>
            <a href="?table=sale&">Доходи</a>
            <br />
            <a href="?table=cost&">Витрати</a>
        </td>
    <?php if (isCost()) { ?>    
    <form method="post" action="mysql/addRowCost.php" name="addProduct">
        <td><input type="text" name="category"></td>
        <td><input type="text" name="name"></td>
        <td><input type="text" name="price"></td>
        <td><input type="submit" value="Додати" name="addProduct"></td>
    </form>
    <?php } else {?>
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
                За <input type="date" name="setStartDate" value="<?=date('Y-m-d', $dateStart)?>"> <!-- Перша дата -->

                <!-- Вибір одного дня або періоду -->

                <?php  if (isset($_POST['datePeriod']) || $dateEnd-$dateStart >= 86400) { ?>
                    <input type="date" name="setEndDate" value="<?=date('Y-m-d', $dateEnd)?>"> <!-- Друга дата -->
                    <input type="submit" value="-" name="deleteEndDate"> <!-- Кнопка для вибору одного дня -->
                <?php } else { ?>
                    <input type="submit" value="+" name="datePeriod"> <!-- Кнопка вибору періоду -->
                <?php } ?>

                <!-- Кінець вибору -->

                <input type="submit" value="setDate" name="setDateBTN"> : <br> <!-- Кнопка відправки дати -->
                <?=$resultSum?> <!-- Виводимо результати доходів і розходів -->
            </form>
           </td>
    </tr>

</tbody>

</table>

<?php require __DIR__ . "/footer.php" ?>
