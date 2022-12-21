<?php require __DIR__ . "/mysqlConnect.php";?>
<?php require_once __DIR__ . "/../functions.php";?>
<?php
    if(isset($_POST['idDelete'])) {
        foreach($_POST['idDelete'] as $delete) {
            $mysqli->query("DELETE FROM `stats_sale` WHERE `stats_sale`.`id` = '$delete'");
        }
    }
    redirect('../index.php');