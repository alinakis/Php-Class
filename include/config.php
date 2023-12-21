<?php
// Starting the session to remember information
session_start();
// Setting up the default timezone  
date_default_timezone_set('Europe/Athens');
//Setting up correct charset for Greek
header ('Content-type: text/html; charset=utf-8');
// including connection information
require_once('connection_data.php');

$version = "1.0.0";
?>