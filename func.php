<?php 

function base_url(){
	$currentPath = $_SERVER['PHP_SELF']; 
	$pathInfo = pathinfo($currentPath); 
	// output: localhost
	$hostName = $_SERVER['HTTP_HOST']; 
	// output: http://
	$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
	return $protocol.$hostName.$pathInfo['dirname']."/";
}
function site_uri( $path ){
	return base_url().$path;
}

function fn_image_thumb( $image_name ){
	return site_uri('product_images/thumb/'.$image_name);
}

function fn_sell_price( $price = 0 ){
	return '<span class="sale-price"><span class="sym">'.SYM.' </span><span>'.number_format($price,2,'.','').'</span></span>';
}
function fn_price( $price = 0 ){
	return '<span class="sale-price"><span class="sym">'.SYM.' </span><span>'.number_format($price,2,'.','').'</span></span>';
}

function fn_retail_price( $price = 0 ){
	return '<span class="retail-price"><span class="sym">'.SYM.' </span><span>'.number_format($price,0,'.','').'</span></span>';
}
function quantity_select( $product_code , $quantity ){
	$max = 10;
	if($quantity < 10){
		$max = $quantity;
	}
	$html = "<select name=\"quantity\">";
	for($i = 1;$i <= $max;$i++):
		$html .="<option value=\"$i\">$i</option>";
	endfor;
	$html .= "</select>";
	return $html;
}
function fn_countries($name = '',$selected = 'mal',$text = false,$link_ajax = ''){
	$countries = array(
		'mal' => 'Malaysia',
		'sin' => 'Singapore',
		'bru' => 'Brunei'
	);
	if($text == true){
		return $countries[$selected];
	}
	$link = !empty($link_ajax) ? "ajax-url=\"$link_ajax\"" : '';
	$html = "<select name=\"countries\" $link >";
	foreach($countries as $key=>$name){
		$selected_attr = "";
		if($selected == $key){
			$selected_attr = "selected";
		}
		$html .= "<option $selected_attr value=\"$key\">$name</option>";
	}
	$html .= "</select>";
	return $html;
}
function fn_shipping( $subtotal , $_country_selected = "mal"){
	global $countries ;
	$cart =& $_SESSION['cart'];
	$shipping = $countries[$_country_selected]['shipping'];
	//Buy 2 free shipping / Minimum purchase > MYR 150, otherwise the shipping fee is MYR 10
	if($_country_selected == 'mal'){
		$total_quan = 0;
		#$total = 0;
		foreach($cart['products'] as $p=>$v){
			$total_quan += $v['quantity_purchased'];
			#$total += $v['selling_price'] * $v['quantity_purchased'];
		}
		if($total_quan >1 OR $cart['subtotal']>150){
			$shipping = 0;
		}
	}elseif($_country_selected == 'sin'){
		if($cart['subtotal'] > 300){
			$shipping = 0;
		}
	}elseif($_country_selected == 'bru'){
		if($cart['subtotal'] > 300){
			$shipping = 0;
		}
	}
	//echo $shipping;exit;
	return $shipping;
}


function fn_apply_coupon( $counpon_code ){
	global $promotions_code;
}
//recalcula
function fn_recalcula_cart(){
	$country_selected =& $_SESSION['country'];
	$cart =& $_SESSION['cart'];
	#$cart_products = $cart['products'];
	//Buy 2 free shipping / Minimum purchase > MYR 150, otherwise the shipping fee is MYR 10
	if($country_selected == 'mal'){
		$total_quan = 0;
		foreach($cart['products'] as $p=>$v){
			$total_quan += $v['quantity_purchased'];
			//$total += $v['selling_price'] * $v['quantity_purchased'];
		}
	}
}