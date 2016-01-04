<?php 

require_once("data/products.php");
require_once("config.php");
require_once("func.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?php echo $title;?> | Test</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<link rel="stylesheet" href="<?php echo site_uri('css/reset.css'); ?>" />
		<link rel="stylesheet" href="<?php echo site_uri('css/style.css'); ?>" />
	</head>
	<body>
		<div id="wrapper">
			<h2 class="head-title"><?php echo $title;?></h2>