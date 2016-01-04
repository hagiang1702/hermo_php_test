<?php 
session_start();
require_once("../func.php");
unset($_SESSION['cart']);
echo site_uri('');exit;
header('Location: '.site_uri(''));