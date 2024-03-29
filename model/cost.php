<?php

    function getCost($dateStart, $dateEnd)
    {
        $sql = "SELECT * FROM `stats_cost` WHERE `date` BETWEEN '$dateStart' AND '$dateEnd'";
        return dbQuery($sql)->fetchAll();
    }

    function getCostOne($id)
    {
        $sql = "SELECT * FROM `stats_cost` WHERE `stats_cost`.`id` = $id";

        return dbQuery($sql)->fetch();
    }

    function addRowCost(array $params)
    {
        $sql = "INSERT INTO `stats_cost` (`category`, `name`, `price`, `date`) VALUES (:category, :name, :price, UNIX_TIMESTAMP());";
        dbQuery($sql, $params);
    }

    function deleteRowCost($row)
    {
        $sql = "DELETE FROM `stats_cost` WHERE `stats_cost`.`id` = '$row'";
        dbQuery($sql);
    }

    function editRowCost($id, $params)
    {
        $sql = "UPDATE `stats_cost` SET `category` = :category, `name` = :name, `price` = :price WHERE `stats_cost`.`id` = $id";
        dbQuery($sql, $params);
    }

    function validateCostErrors(array &$fields) : array {
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
