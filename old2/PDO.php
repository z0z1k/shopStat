<?php

    $db = new PDO('mysql:host=localhost;dbname=stats;charset=utf8', 'z0z1k', 'EtoPassword123');


    $sql = "INSERT INTO stats_sale (product, price, profit, remains, date) VALUES (:product, :price, :profit, :remains, :date)";
    $query = $db->prepare($sql);

    $name = 'Motul 5100 10w40 1L';
    $price = 400;
    $profit = 100;
    $remains = 2;
    $date = 123;

    $params = [
        'product' => $name,
        'price' => $price,
        'profit' => $profit,
        'remains' => $remains,
        'date' => $date
    ];

    $query->execute($params);
    $errInfo = $query->errorInfo();

    if ($errInfo[0] !== PDO::ERR_NONE) {
        echo $errInfo[2];
        exit();
    }
