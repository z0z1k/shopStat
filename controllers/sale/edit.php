<?php

$pageTitle = 'Редагувати рядок';
$id = intval($routerRes['params']['id']);
var_dump($id);
$row = getOne($id);
$pageContent = '1';