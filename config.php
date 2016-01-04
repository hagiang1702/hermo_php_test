<?php
session_start();

define('CURRENCY',"RM");
define('SYM',"RM");

$countries = array(
		'mal' => array('name'=>'Malaysia','shipping'=>0),
		'sin' => array('name'=>'Singapore','shipping'=>10),
		'bru' => array('name'=>'Brunei','shipping'=>15)
	);
function fn_set_countries()	{
	global $countries ;
	$countries = array(
		'mal' => array('name'=>'Malaysia','shipping'=>10),
		'sin' => array('name'=>'Singapore','shipping'=>20),
		'bru' => array('name'=>'Brunei','shipping'=>25)
	);
}

function fn_set_coupons(){
	global $promotions_code;
	$promotions_code = array(
		'OFF5PC' => array('conditions'=>array('type'=>'sum_quantity','value'=>2),'bonus'=>array('value'=>5,'type'=>'discount_percent')),
		'GIVEME15' => array('conditions'=>array(),'bonus'=>array('value'=>100,'type'=>'discount_total')),
	);
}
//set global
fn_set_countries();
fn_set_coupons();