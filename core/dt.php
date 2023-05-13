<?php

    function todayStartInt()
    {
        $dt = date('Y-m-d');
        return strtotime($dt);
    }

    function setDateCookies($dateStart, $dateEnd) {
        setcookie('dateStart', $dateStart, time()+600, '/');
        setcookie('dateEnd', $dateEnd, time()+600, '/');
        $_COOKIE['dateStart'] = $dateStart;
        $_COOKIE['dateEnd'] = $dateEnd;
    }

    if (!isset($_COOKIE['dateStart'])) {
        $dateStart = todayStartInt(); 
    } else { 
        $dateStart = $_COOKIE['dateStart'];
    }

    if (!isset($_COOKIE['dateEnd'])) {
        $dateEnd = todayStartInt() + 86399;
    } else { 
        $dateEnd = $_COOKIE['dateEnd'];
    }

    if (isset($_POST['setDateBTN'])) {
        $dateStart = strtotime($_POST['setStartDate']);

        if (!isset($_POST['setEndDate'])) {
            $dateEnd = $dateStart + 86399;            
        } else {
            $dateEnd = strtotime($_POST['setEndDate']) + 86399;
        }
    }

    if (isset($_POST['dateDay']))   {
        $dateEnd = $dateStart + 86399;
    }

    setDateCookies($dateStart, $dateEnd);

    function timeFormat()
    {
        if ($_COOKIE['dateEnd'] > $_COOKIE['dateStart'] + 86399) {
            return "d.m.Y \n G:i:s";
        } else {
            return "G:i:s";
        }
    }