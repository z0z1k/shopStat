<?php

    $productsSale = getSale($dateStart, $dateEnd);

    $validateErrors = [];

    if (isset($_POST['addProduct'])) {

        $fields = extractFields($_POST, ['product', 'price', 'profit', 'remains']);
        $validateErrors = validateSaleErrors($fields);

        if (empty($validateErrors)){
            addRowSale($fields);
            header('Location: ' . BASE_URL, true, $permanent ? 301 : 302);
            exit();
        }
    }

    if (isset($_POST['deleteButton'])) {
        foreach ($_POST['idDelete'] as $row) {
            deleteRowSale($row);
        }

        header('Location: ' . BASE_URL, true, $permanent ? 301 : 302);
        exit();
    }

    $pageTitle = 'Доходи';
    $pageContent = template('sale/v_all', [
        'products' => $productsSale,
        'dateStart' => $dateStart,
        'dateEnd' => $dateEnd,
    ]);

    file_put_contents('1', $pageContent);
