<?php 
include "../config.php";
include "../func.php";

$coupon_code = $_REQUEST['coupon_code'];
check_coupons($coupon_code);
//check 
function check_coupons( $coupon_code ){
	global $promotions_code;
	$cart = & $_SESSION['cart'];
	$coupon_code = strtoupper($coupon_code);
	unset($cart['coupon_code']);
	foreach($promotions_code as $code=>$promotion_data){
		$code = strtoupper($code);
		
		if($code == $coupon_code){
			#print_r($promotion_data);exit;
			$cart['coupon_code'] = $code;
			#print_r($cart);
			
			//recalcula cart total
			
			$conditions = $promotion_data['conditions'];
			$bonus 		= $promotion_data['bonus'];
			//get type 
			$condition_type = !empty($conditions['type']) ? $conditions['type'] : "";
			$condition_value = !empty($conditions['value']) ? $conditions['value'] : "";
			$bonus_type = $bonus['type'];
			$bonus_value = $bonus['value'];
			if($condition_type == 'sum_quantity'){
				//get total quantity 
				$total_quan = 0;
				$total = 0;
				foreach($cart['products'] as $p=>$v){
					$total_quan += $v['quantity_purchased'];
					$total += $v['selling_price'] * $v['quantity_purchased'];
				}
				if($total_quan >= $condition_value){
					//$cart['total'] = 
					if($bonus_type == 'discount_percent'){
						$discount = $bonus_value/100 * $total;
						//echo $discount;exit;
						$cart['discount'] = $discount;
					}
				}
				
			}
			if(empty($condition_type) AND !empty($bonus)){
				#print_r($bonus);exit;
				if($bonus_type == 'discount_total'){
					$cart['discount'] = $bonus_value;
				}
			}
			
			#print_r($cart);exit;
		}
	}
	#print_r($promotions_code);
}
#$_SESSION['coupon_code'] = $coupon_code;



