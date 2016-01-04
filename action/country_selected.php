<?php 
include "../config.php";
include "../func.php";

$_country_selected = $_REQUEST;

$_SESSION['country'] = $_country_selected['country'];
echo json_encode($_country_selected);die();


