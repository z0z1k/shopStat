<?php 
require __DIR__ . "/mysqlConnect.php";
require_once __DIR__ . "/../functions.php";

    if(isset($_POST['idDelete'])) {
        foreach($_POST['idDelete'] as $delete) {
            $mysqli->query("DELETE FROM `stats_cost` WHERE `stats_cost`.`id` = '$delete'");
        }
    }
    redirect('../index.php?table=cost');