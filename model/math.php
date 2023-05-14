<?php

    function getSumPriceSale($dateStart, $dateEnd)
    {
        $sql = "SELECT SUM(`price`) AS value_sum FROM `stats_sale` WHERE `date` BETWEEN $dateStart AND $dateEnd"; 
        $row = dbQuery($sql)->fetch();
        if ($row['value_sum'] == NULL) {
            return 0;
        } else {
            return $row['value_sum'];
        }
    }

    function getSumProfitSale($dateStart, $dateEnd)
    {
        $sql = "SELECT SUM(`profit`) AS value_sum FROM `stats_sale` WHERE `date` BETWEEN $dateStart AND $dateEnd"; 
        $row = dbQuery($sql)->fetch();
        if ($row['value_sum'] == NULL) {
            return 0;
        } else {
            return $row['value_sum'];
        }
    }

    function getSumPriceCost($dateStart, $dateEnd)
    {
        $sql = "SELECT SUM(`price`) AS value_sum FROM `stats_cost` WHERE `date` BETWEEN $dateStart AND $dateEnd"; 
        $row = dbQuery($sql)->fetch();
        if ($row['value_sum'] == NULL) {
            return 0;
        } else {
            return $row['value_sum'];
        }
    }

    function getDayCount($dateStart, $dateEnd)
    {
        return intval(round(($dateEnd - $dateStart) / 86399));
    }

    function getPercentage($price, $profit)
    {
        if (!empty($profit) && !empty($price)){
            return round($profit * 100 / $price, 2);
        } else {
            return "~";
        }
    }