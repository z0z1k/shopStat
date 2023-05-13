<?php

    $products = getTable($dateStart, $dateEnd);

    $validateErrors = [];

    if (isset($_POST['addProduct'])) {

        $fields = extractFields($_POST, ['product', 'price', 'profit', 'remains']);
        $validateErrors = validateErrors($fields);

        if (empty($validateErrors)){
            addRow($fields);
            header('Location: ' . BASE_URL, true, $permanent ? 301 : 302);
        }
    }

    if (isset($_POST['deleteButton'])) {
        foreach ($_POST['idDelete'] as $row) {
            deleteRow($row);
        }

        header('Location: ' . BASE_URL, true, $permanent ? 301 : 302);
    }

    $pageTitle = 'Доходи';
    $pageContent = template('v_sale', [
        'products' => $products,
        'dateStart' => $dateStart,
        'dateEnd' => $dateEnd,
        'validateErrors' => $validateErrors,
    ]);

    file_put_contents('1', $pageContent);
