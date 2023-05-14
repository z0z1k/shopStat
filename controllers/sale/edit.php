<?php

$pageTitle = 'Редагувати рядок';
$id = intval($routerRes['params']['id']);
$product = getSaleOne($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $params = extractFields($_POST, ['product', 'price', 'profit', 'remains']);
    $validateErrors = validateSaleErrors($params);

    if(empty($validateErrors)){
        editRowSale($id, $params);

        header('Location: ' . BASE_URL);
        exit();
    }
}

$pageContent = template('sale/v_row', [
    'product' => $product,
]);