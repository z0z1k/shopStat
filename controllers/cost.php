<?php

    $products = getTable($dateStart, $dateEnd);

    $validateErrors = [];

    if (isset($_POST['addProduct'])) {

        $fields = extractFields($_POST, ['category', 'name', 'price']);
        $validateErrors = validateErrors($fields);

        if (empty($validateErrors)){
            addRow($fields);
            header('Location: ' . 'index.php?c=cost', true, $permanent ? 301 : 302);
        }
    }

    if (isset($_POST['deleteButton'])) {
        foreach ($_POST['idDelete'] as $row) {
            deleteRow($row);
        }

        header('Location: ' . 'index.php?c=cost', true, $permanent ? 301 : 302);
    }

    $pageTitle = 'Витрати';
    $pageContent = template('v_cost', [
        'products' => $products,
        'dateStart' => $dateStart,
        'dateEnd' => $dateEnd,
        'validateErrors' => $validateErrors,
    ]);


