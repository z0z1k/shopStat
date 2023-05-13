<?php

    function getTable($dateStart, $dateEnd)
    {
        $sql = "SELECT * FROM `stats_cost` WHERE `date` BETWEEN '$dateStart' AND '$dateEnd'";

        return dbQuery($sql)->fetchAll();
    }

    function addRow(array $params)
    {
        $sql = "INSERT INTO `stats_cost` (`category`, `name`, `price`, `date`) VALUES (:category, :name, :price, UNIX_TIMESTAMP());";
        dbQuery($sql, $params);
    }

    function deleteRow($row)
    {
        $sql = "DELETE FROM `stats_cost` WHERE `stats_sale`.`id` = '$row'";
        dbQuery($sql);
    }

    function validateErrors(array &$fields) : array {
        $errors = [];

        $fields['price'] = intval($fields['price']);

        if (mb_strlen($fields['category'], 'UTF-8') < 3) {
            $errors[] = 'Назва категорії не може бути коротша 3 символів';
        }

        if (mb_strlen($fields['name'], 'UTF-8') < 3) {
            $errors[] = "Ім'я не може бути коротше 3 символів";
        }

        $fields['category'] = htmlspecialchars($fields['category']);
        $fields['name'] = htmlspecialchars($fields['name']);

        return $errors;
    }
