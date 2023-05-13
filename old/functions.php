<?php
require_once __DIR__ . "/mysql/mysqlConnect.php";
function Redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);
        
    exit();
}

function returnDate()
{
	return date('Y-m-d');
}

function tableName()
{
	if (isset($_GET['table']) && $_GET['table'] == 'cost') {
    	return 'stats_cost';
    } else {
        return 'stats_sale';
    }
}

function isCost()
{
	if (isset($_GET['table']) && $_GET['table'] == 'cost') {
    	return true;
    } else {
        return false;
    }
}

function timeFormat()
{
	if (isset($_COOKIE['dateEnd']) && $_COOKIE['dateEnd'] >= $_COOKIE['dateStart'] + 86400 || isset($_POST['setEndDate'])) {
		return "d.m.Y \n G:i:s";
	} else {
		return "G:i:s";
	}
}

function getSumFromTable($dateStart, $dateEnd, $row, $tableName = "stats_sale")
{
	global $mysqli;
	$result = $mysqli->query("SELECT SUM($row) AS value_sum FROM `$tableName` WHERE `date` BETWEEN '$dateStart' AND '$dateEnd'"); 
    $row = mysqli_fetch_assoc($result);
    if ($row['value_sum'] == NULL) {
        return 0;
    } else {
        return $row['value_sum'];
    }
}

function getPercentage($profit, $price)
{
	if (!empty($profit) && !empty($price)){
		return round($profit * 100 / $price, 2);
	} else {
		return "~";
	}
}