<?php
function Redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);
        
    exit();
}

function getSum()
{
	$numm = 0;
	for ($i = 0; $i < func_num_args(); $i++) {
		$arg[$i] = func_get_arg($i);
		$numm += $arg[$i];
	}
	return $numm;
}

function returnDate()
{
	return date('Y-m-d');
}

function tableName()
{
	if (isset($_GET['table']) && $_GET['table'] == 'cost') {
    	return 'stats_cost';
    } else {
        return 'stats_sale';
    }
}

function isCost()
{
	if (isset($_GET['table']) && $_GET['table'] == 'cost') {
    	return true;
    } else {
        return false;
    }
}

function timeFormat()
{
	if (isset($_POST['setEndDate'])) {
		return "d.m.Y G:i:s";
	} else {
		return "G:i:s";
	}
}