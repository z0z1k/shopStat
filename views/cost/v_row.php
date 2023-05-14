<thead>
    <tr>
        <th class="text-center">Категорія</th>
        <th class="text-center">Назва</th>
        <th colspan="2" class="text-center">Ціна</th>
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