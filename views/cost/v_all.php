<!-- Шапка -->
<thead>   
            <tr>
                <th class="text-center"><button type="submit" name="deleteButton" value="Видалити"><img class="icon" src="<?=BASE_URL?>assets/img/deleteIcon.png"></th> <!-- Кнопка видалення -->

                <th class="text-center">Категорія</th>
                <th class="text-center">Назва</th>
                <th class="text-right">Ціна</th>
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
                    <a href="<?=BASE_URL?>cost/<?=$product['id']?>"><img src="<?=BASE_URL?>assets/img/editIcon.png" class="icon"></a> <!-- Кнопка редагувати -->
                </td>
                <td class="text-center"><?=$product['category']?></td>  <!-- Категорія -->
                <td class="text-center"><?=$product['name']?></td> <!-- Назва -->
                <td class="text-right"><?=$product['price']?></td> <!-- Ціна -->
                <td><?=date(timeFormat(), $product['date'])?></td>  <!-- Час -->
            
            </tr>
            <?php } ?>
           <!-- Кінець рядків з даними -->

            <tr>
                <td>
                    <a href="<?=BASE_URL?>">Доходи</a>
                    <br />
                    <a href="<?=BASE_URL?>cost">Витрати</a>
                </td>
    

                <td><input type="text" name="category"></td>
                <td><input type="text" name="name"></td>
                <td><input type="text" name="price"></td>
                <td><input type="submit" value="Додати" name="addProduct"></td>

            </tr>
    
        </tbody>