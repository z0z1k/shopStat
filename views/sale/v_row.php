<thead>
    <tr>
        <th class="text-center">Товар</th> <!-- Товар -->
            <th class="text-center">Продажа</th> <!-- Продажа -->
            <th class="text-right">Чисті</th> <!-- Чисті -->
            <th colspan = "2" class="text-center">Залишок</th> <!-- Залишок -->
        </tr>
</thead>
        <tr>
            <form method="post">
                <td><input type="text" name="product" value="<?=$product['product']?>"></td> <!-- Товар -->
                <td><input type="text" name="price" value="<?=$product['price']?>"></td> <!-- Продажа -->
                <td><input type="text" name="profit" value="<?=$product['profit']?>"></td> <!-- Чисті -->
                <td><input type="text" name="remains" value="<?=$product['remains']?>"></td> <!-- Залишок -->
                <td><input type="submit" value="Редагувати" name="edit"></td> <!-- Кнопка "Редагувати" -->
            </form>
        </tr>