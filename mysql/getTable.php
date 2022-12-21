<?php require_once __DIR__ . "/mysqlConnect.php";?>
<?php require_once __DIR__ . "/../functions.php";?>

<?php

    if (isset($_POST['setDate'])) {
        $dateStart = strtotime($_POST['setDate']);
    } else {
        $dateStart = strtotime(returnDate());
    }

    $dateEnd = $dateStart + 83399;

    $tableName = tableName();

    $items = $mysqli->query("SELECT * FROM `$tableName` WHERE `date` BETWEEN '$dateStart' AND '$dateEnd'");
    
    $table = [];
    while (($row = $items->fetch_assoc()) != false) {
        $table[] = $row;
    }
    
    $result = $mysqli->query("SELECT SUM(profit) AS value_sum FROM `stats_sale` WHERE `date` BETWEEN '$dateStart' AND '$dateEnd'"); 
    $row = mysqli_fetch_assoc($result); 
    $summProfit = $row['value_sum'];

    $result = $mysqli->query("SELECT SUM(price) AS value_sum FROM `stats_cost` WHERE `date` BETWEEN '$dateStart' AND '$dateEnd'"); 
    $row = mysqli_fetch_assoc($result); 
    $summCost = $row['value_sum'];