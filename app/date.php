<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/helpers/Cookie.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/helpers/Redirect.php";

Cookie::addCheck("dateStart", (string)strtotime(returnDate()));
Cookie::addCheck("dateEnd", (string)(Cookie::get('dateStart') + 86399));

if (isset($_POST['setDateBTN'])) {
    Cookie::add("dateStart", (string)(strtotime($_POST['setStartDate'])));
    
    if (!isset($_POST['setEndDate'])) {
        Cookie::add("dateEnd", (string)(Cookie::get('dateStart')+86399));
    } else {
        
        if (strtotime($_POST['setStartDate']) > strtotime(returnDate()) && strtotime($_POST['setStartDate']) > strtotime(returnDate()) + 86399) {
            Cookie::add("dateStart", (string)strtotime(returnDate()));
            Cookie::add("dateEnd", (string)(Cookie::get('dateStart') + 86399));
        }

        if (strtotime($_POST['setEndDate']) > (int)strtotime(returnDate()) + 86399) {
            Cookie::add("dateEnd", (string)strtotime(returnDate()) + 86399);

            if (strtotime($_POST['setStartDate']) >= $_COOKIE['dateEnd']) {
                Cookie::add('dateStart', (string)($_COOKIE['dateEnd'] - 86399));
            }
        } else {
            Cookie::add("dateEnd", (string)(strtotime($_POST['setEndDate'])) + 86399);
        }
    }
} 

if (isset($_POST['deleteEndDate'])) {
    Cookie::remove("dateEnd");
    Cookie::add("dateStart", (string)(strtotime($_POST['setStartDate'])));
    Redirect::Redirect();
}
