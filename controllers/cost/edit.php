<?php

$pageTitle = 'Редагувати рядок';
$id = intval($routerRes['params']['id']);
$product = getCostOne($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $params = extractFields($_POST, ['category', 'name', 'price']);
    $validateErrors = validateCostErrors($params);

    if(empty($validateErrors)){
        editRowCost($id, $params);

        header('Location: ' . BASE_URL . 'cost');
        exit();
    }
}

$pageContent = template('cost/v_row', [
    'product' => $product,
]);