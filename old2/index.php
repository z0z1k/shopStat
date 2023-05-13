<?php
require __DIR__ . "/header.php"; // підключення функцій
require_once __DIR__ . "/mysql/getTable.php"; // підключення таблиці
require_once __DIR__ . "/functions.php"; // підключення функцій
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
    <th class="text-center"><button type="submit" name="checkBox" value="Видалити"><img class="icon" src="img/deleteIcon.png"></th> <!-- Кнопка видалення -->
    
    <!-- Шапка для витрат -->
    <?php if (isCost()) { ?>
        <th class="text-center">Категорія</th>
        <th class="text-center">Назва</th>
        <th class="text-right">Ціна</th>
        <th>Час</th>
    <!-- -->

    <!-- Шапка  для доходів -->
    <?php } else { ?>
        <th class="text-center">Товар</th>
        <th class="text-right">Продажа</th>
        <th class="text-right">Чисті</th>
        <th class="text-right">Залишок</th>
        <th>Час</th>
    <?php } ?>
    <!-- -->

    </tr>
</thead>
<!-- Кінець шапки -->

<tbody>
    <!-- Рядки з даними -->
    <?php foreach ($table as $product) { ?>
    <tr>

    <!-- Рядки витрат -->
    <?php if (isCost()) { ?>
        <td class="text-right">
            <input type="checkbox" name="idDelete[]" value="<?=$product['id']?>"> <!-- Чекбокс для видалення -->
            <a href="mysql/editCost.php?editId=<?=$product['id']?>"><img src="img/editIcon.png" class="icon"></a> <!-- Кнопка редагувати -->
        </td>
        <td class="text-center"><?=$product['category']?></td>  <!-- Категорія -->
        <td class="text-center"><?=$product['name']?></td> <!-- Назва -->
        <td class="text-right"><?=$product['price']?></td> <!-- Ціна -->
        <td><?=date(timeFormat(), $product['date'])?></td>  <!-- Час -->
    <!-- -->

    <!-- Рядки доходів -->
    <?php } else { ?>
        <td class="text-right">
            <input type="checkbox" name="idDelete[]" value="<?=$product['id']?>"> <!-- Чекбокс для видалення -->
            <a href="mysql/editSale.php?editId=<?=$product['id']?>"><img src="img/editIcon.png" class="icon"></a> <!-- Кнопка редагувати -->
        </td>
        <td class="text-center"><?=$product['product']?></td> <!-- Товар -->
        <td class="text-right"><?=$product['price']?></td> <!-- Продажа -->
        <td class="text-right"><?=$product['profit']?></td> <!-- Чисті -->
        <td class="text-right"><?=$product['remains']?></td> <!-- Залишок -->
        <td><?=date(timeFormat(), $product['date'])?></td> <!-- Дата -->
    <?php } ?>
    <!-- -->

    </tr>
    <?php } ?>
    </form> <!-- Кінець форми для видалення -->
    <!-- Кінець рядків з даними -->

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

<?php require __DIR__ . "/footer.php" ?> <!-- Підключення футеру -->
