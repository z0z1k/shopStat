<?php

    $productsCost = getCost($dateStart, $dateEnd);

    $validateErrors = [];

    if (isset($_POST['addProduct'])) {

        $fields = extractFields($_POST, ['category', 'name', 'price']);
        $validateErrors = validateCostErrors($fields);

        if (empty($validateErrors)){
            addRowCost($fields);
            header('Location: ' . BASE_URL . 'cost', true, $permanent ? 301 : 302);
            exit();
        }
    }

    if (isset($_POST['deleteButton'])) {
        foreach ($_POST['idDelete'] as $row) {
            deleteRowCost($row);
        }

        header('Location: ' . BASE_URL . 'cost', true, $permanent ? 301 : 302);
        exit();
    }

    $pageTitle = 'Витрати';
    $pageContent = template('cost/v_all', [
        'products' => $productsCost,
        'dateStart' => $dateStart,
        'dateEnd' => $dateEnd,
        'validateErrors' => $validateErrors,
    ]);


