<?php
require_once __DIR__ . "/../helpers/Cookie.php";
require_once __DIR__ . "/../helpers/Redirect.php";

Cookie::addCheck("dateStart", (string)strtotime(returnDate()));
Cookie::addCheck("dateEnd", (string)(Cookie::get('dateStart')+86399));

if (isset($_POST['setDateBTN'])) {
    Cookie::add("dateStart", (string)(strtotime($_POST['setStartDate'])));
    
    if (!isset($_POST['setEndDate'])) {
        Cookie::add("dateEnd", (string)(Cookie::get('dateStart')+86399));
    } else {
        Cookie::add("dateEnd", (string)(strtotime($_POST['setEndDate'])));
    }
} 

if (isset($_POST['deleteEndDate'])) { // Якщо натиснули кнопку видалення другої дати, то
    Cookie::remove("dateEnd");
    Cookie::add("dateStart", (string)(strtotime($_POST['setStartDate'])));
    Redirect::Redirect(); // перезавантажуємо таблицю
}