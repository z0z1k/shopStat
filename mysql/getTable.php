<?php 
require_once __DIR__ . "/mysqlConnect.php";
require_once __DIR__ . "/../functions.php";

    $dateStart = $_COOKIE['dateStart'] ?? strtotime(returnDate());
    
    if (isset($_POST['setDateBTN'])) {
        $dateStart = strtotime($_POST['setStartDate']);
    }

    if (isset($_COOKIE['dateEnd'])) {
        $dateEnd = $_COOKIE['dateEnd'];  
    } else if (!isset($_POST['setEndDate'])) {
        $dateEnd = $dateStart + 86399;
    }

    if (isset($_POST['setEndDate'])) {
        $dateEnd = strtotime($_POST['setEndDate']);
        
        if ($dateEnd >= strtotime(returnDate())) {
            $dateEnd = strtotime(returnDate());
            if ($dateStart >= $dateEnd) {
                $dateStart = $dateEnd - 86400;
            }
        }
    
        if ($dateStart >= $dateEnd) {
            $dateEnd = $dateStart + 86400;
        }
        setcookie("dateEnd", $dateEnd, time()+600);
    }

    if (isset($_POST['deleteEndDate'])) {
        setcookie("dateEnd", $dateEnd, time()-600);
        $dateStart = strtotime($_POST['setStartDate']);
        setcookie("dateStart", $dateStart , time()+600);
        redirect('index.php');
    }

    setcookie("dateStart", $dateStart , time()+600);

    $tableName = tableName();

    $items = $mysqli->query("SELECT * FROM `$tableName` WHERE `date` BETWEEN '$dateStart' AND '$dateEnd'");
    
    $table = [];
    while (($row = $items->fetch_assoc()) != false) {
        $table[] = $row;
    }
    
    $result = $mysqli->query("SELECT SUM(profit) AS value_sum FROM `stats_sale` WHERE `date` BETWEEN '$dateStart' AND '$dateEnd'"); 
    $row = mysqli_fetch_assoc($result); 
    if ($row['value_sum'] == NULL) {
        $sumProfit = 0;
    } else {
        $sumProfit = $row['value_sum'];
    }

    $sumCost = 0;
    $result = $mysqli->query("SELECT SUM(price) AS value_sum FROM `stats_cost` WHERE `date` BETWEEN '$dateStart' AND '$dateEnd'"); 
    $row = mysqli_fetch_assoc($result);
    if ($row['value_sum'] == NULL) {
        $sumCost = 0;
    } else {
        $sumCost = $row['value_sum'];
    }