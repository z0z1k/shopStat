<?php 
require_once __DIR__ . "/mysqlConnect.php"; // підключення до БД
require_once __DIR__ . "/../functions.php"; // підключення функцій
require_once __DIR__ . "/../app/date.php";

    $dateStart = Cookie::get("dateStart");
    $dateEnd = Cookie::get("dateEnd");
    

    $tableName = tableName(); // записуємо у змінній назву таблиці, з якою будемо працювати

    $items = $mysqli->query("SELECT * FROM `$tableName` WHERE `date` BETWEEN '$dateStart' AND '$dateEnd'"); // Записуємо дані таблиці у змінну
    
    $table = []; // створюємо масив для даних з таблиці
    while (($row = $items->fetch_assoc()) != false) { // Беремо рядок з таблиці
        $table[] = $row; // Записуємо рядок таблиці у масив
    }

    $sumPrice = getSumFromTable($dateStart, $dateEnd, "price", "stats_sale"); // Сума обороту
    $sumProfit = getSumFromTable($dateStart, $dateEnd, "profit", "stats_sale"); // Сума чистих доходів
    $sumCost = getSumFromTable($dateStart, $dateEnd, "price", "stats_cost"); // Сума витрат
    $sumDifference = $sumProfit - $sumCost; // Різниця між чистими доходами і витратами

    $resultSum = "сума грязних " . $sumPrice . ", сума чистих " . $sumProfit . ", витрати " . $sumCost . ", загальний дохід: " . $sumDifference . ". Від суми продажу дохід " . getPercentage($sumProfit, $sumPrice) . "%"; // Результат для виводу на головній сторінці

    if ($dateEnd >= $dateStart + 86400){ // Якщо різниця між першою і другою датою більше рівне доби
        $dayCount = ceil(($dateEnd - $dateStart) / 86399); // Рахуємо кількість днів
        $tempDateEnd = $dateEnd; // Створюємо тимчасову другу дату
        $tempDateStart = $tempDateEnd - 86399; // Створюємо тимчасову першу дату, виставляємо її на початок останнього дня
        for ($i = 0; $i < $dayCount; $i++) { //Для кожного дня:
            $sumPrice = getSumFromTable($tempDateStart, $tempDateEnd, "price", "stats_sale"); // рахуємо суму обороту
            $sumProfit = getSumFromTable($tempDateStart, $tempDateEnd, "profit", "stats_sale"); // рахуємо суму чистих
            $sumCost = getSumFromTable($tempDateStart, $tempDateEnd, "price", "stats_cost"); // рахуємо суму витрат
            $sumDifference = $sumProfit - $sumCost; // рахуємо різницю між чистими доходами і витратами

            $resultSum .= "<br> " . date("d.m.Y", $tempDateStart) . " сума грязних " . $sumPrice . ", сума чистих " . $sumProfit . ", витрати " . $sumCost . ", загальний дохід: " .$sumDifference; // Додаємо в результат дані за день
            $tempDateEnd -= 86400; // Змінюємо другу дату на добу назад
            $tempDateStart -= 86400; // Першу дату також змінюємо на добу назад
        }
    }