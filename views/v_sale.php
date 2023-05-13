<!-- Шапка -->
<thead>   
            <tr>
                <th class="text-center"><button type="submit" name="deleteButton" value="Видалити"><img class="icon" src="img/deleteIcon.png"></th> <!-- Кнопка видалення -->

                    <th class="text-center">Товар</th>
                    <th class="text-right">Продажа</th>
                    <th class="text-right">Чисті</th>
                    <th class="text-right">Залишок</th>
                    <th>Час</th>

             </tr>
        </thead>
        <!-- Кінець шапки -->

        <tbody>
              

            <!-- Рядки з даними -->
            <?php foreach ($products as $product) { ?>
            <tr>

                <td class="text-right">
                    <input type="checkbox" name="idDelete[]" value="<?=$product['id']?>"> <!-- Чекбокс для видалення -->
                    <a href="mysql/editSale.php?editId=<?=$product['id']?>"><img src="img/editIcon.png" class="icon"></a> <!-- Кнопка редагувати -->
                </td>
                <td class="text-center"><?=$product['product']?></td> <!-- Товар -->
                <td class="text-right"><?=$product['price']?></td> <!-- Продажа -->
                <td class="text-right"><?=$product['profit']?></td> <!-- Чисті -->
                <td class="text-right"><?=$product['remains']?></td> <!-- Залишок -->
                <td><?=date(timeFormat(), $product['date'])?></td> <!-- Дата -->
            
            </tr>
            <?php } ?>
           <!-- Кінець рядків з даними -->

            <tr>
                <td>
                    <a href="<?=BASE_URL?>">Доходи</a>
                    <br />
                    <a href="<?=BASE_URL?>cost">Витрати</a>
                </td>
    

                <td><input type="text" name="product"></td>
                <td><input type="text" name="price"></td>
                <td><input type="text" name="profit"></td>
                <td><input type="text" name="remains"></td>
                <td><input type="submit" value="Додати" name="addProduct"></td>

            </tr>
    

            <tr>
                <td colspan="6">
                        За <input type="date" name="setStartDate" value="<?=date('Y-m-d', $dateStart)?>"> <!-- Перша дата -->

                        <!-- Вибір одного дня або періоду -->

                        <?php  if (isset($_POST['datePeriod']) || $dateEnd-$dateStart > 86399) { ?>
                            <input type="date" name="setEndDate" value="<?=date('Y-m-d', $dateEnd)?>"> <!-- Друга дата -->
                            <input type="submit" value="-" name="dateDay"> <!-- Кнопка для вибору одного дня -->
                        <?php } else { ?>
                            <input type="submit" value="+" name="datePeriod"> <!-- Кнопка вибору періоду -->
                        <?php } ?>

                        <!-- Кінець вибору -->

                        <input type="submit" value="setDate" name="setDateBTN"> : <br> <!-- Кнопка відправки дати -->
                        <?=sumPrice()?> <!-- Виводимо результати доходів і розходів -->
                        <? foreach($validateErrors as $error): ?>
                            <script> alert("<?=$error?>"); </script>
                        <? endforeach ?>
                </td>
            </tr>

        </tbody>