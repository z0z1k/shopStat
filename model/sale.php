<?php

    function getTable($dateStart, $dateEnd)
    {
        $sql = "SELECT * FROM `stats_sale` WHERE `date` BETWEEN '$dateStart' AND '$dateEnd'";

        return dbQuery($sql)->fetchAll();
    }

    function getOne($id)
    {
        $sql = "SELECT * FROM `stats_sale` WHERE `stats_sale`.`id` = $id'";

        return dbQuery($sql)->fetch();
    }

    function addRow(array $params)
    {
        $sql = "INSERT INTO `stats_sale` (`product`, `price`, `profit`, `remains`, `date`) VALUES (:product, :price, :profit, :remains, UNIX_TIMESTAMP());";
        dbQuery($sql, $params);
    }

    function deleteRow($row)
    {
        $sql = "DELETE FROM `stats_sale` WHERE `stats_sale`.`id` = '$row'";
        dbQuery($sql);
    }

    function validateErrors(array &$fields) : array {
        $errors = [];

        $fields['price'] = intval($fields['price']);
        $fields['profit'] = intval($fields['profit']);
        $fields['remains'] = intval($fields['remains']);

        if (mb_strlen($fields['product'], 'UTF-8') < 5) {
            $errors[] = 'назва товару не може бути коротша 4 символів';
        }

        $fields['product'] = htmlspecialchars($fields['product']);

        return $errors;
    }

    function sumPrice()
    {        
        $dateStart = $_COOKIE['dateStart'];
        $dateEnd = $_COOKIE['dateEnd'];
        $sql = "SELECT SUM(price) AS value_sum FROM `stats_sale` WHERE `date` BETWEEN '$dateStart' AND '$dateEnd'";
        
        $result = dbQuery($sql)->fetch();

        if ($result['value_sum'] === NULL) {
            $result['value_sum'] = 0;
        }

        return $result['value_sum'];
    }