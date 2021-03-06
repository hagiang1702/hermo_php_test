<?php 
$title = "Confirm Checkout";
include "partials/header.php"; 

?>
<?php 
	$cart =& $_SESSION['cart'];
	$cart['discount'] = !empty($cart['discount']) ? $cart['discount'] : 0;
	$cart['products'] = !empty($cart['products']) ? $cart['products'] : array();
	$cart_products = $cart['products'];
	$country_selected =& $_SESSION['country'];
	if(empty($country_selected))
		$country_selected = 'mal';	
	if(!empty($_REQUEST)){
		$post_data = $_REQUEST;
		
		$product_purchased = $products[$post_data['product_id']];
		$product_purchased['quantity_purchased'] = $post_data['quantity'];
		
		if(!empty($cart_products[$post_data['product_id']])){
			$amount_new = $cart_products[$post_data['product_id']]['quantity_purchased'] + $post_data['quantity'];
			$cart_products[$post_data['product_id']]['quantity_purchased'] = $amount_new;
		}
		else{
			$cart_products[$post_data['product_id']] = $product_purchased;
		}
		$cart['products']  = $cart_products;
		echo "ok";exit;
	}
	
	//cart info
	$cart['saved'] = 0;
	$cart['original_price'] = 0;
	$cart['subtotal'] = 0;
	$cart['total'] = 0;//!empty($cart['total']) ? $cart['total'] : 0;
?>
	<div class="main">
		<div class="ajax-country">
			
		</div>
		<table class="table checkout-list medium">
			<thead>
				<tr>
					<th>Items</th>
					<th>Descriptions</th>
					<th>Unit price</th>
					<th>Quantity</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($cart_products as $p):
				$retail_price = !empty($p['retail_price']) ? $p['retail_price'] : $p['selling_price'];
				$cart['saved'] += ($retail_price - $p['selling_price'] )  *  $p['quantity_purchased'];
				$cart['original_price'] += $p['quantity_purchased']*$retail_price;
				$cart['subtotal'] = $cart['original_price'] - $cart['saved'];
				
				#if($cart['total'] == 0){
				$cart['total'] += $p['selling_price'] * $p['quantity_purchased'];
				#}
				
			?>
				<tr>
					<td><img class="w60" src="<?php echo fn_image_thumb($p['image']);?>" /></td>
					<td><?php echo $p['product_name']?></td>
					<td>
						<div class="list-price">
							<?php echo fn_sell_price($p['selling_price']);?>
							<?php if(!empty($p['retail_price'])):?>
							<?php echo fn_retail_price($p['retail_price']);?>
							<?php endif;?>
						</div>
					</td>
					<td><?php echo $p['quantity_purchased']?></td>
					<td><?php 
						#echo $p['retail_price'];
						#echo "<br />";
						#echo $p['selling_price'];
						echo fn_sell_price($p['quantity_purchased']*$p['selling_price'])?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		<?php #fn_recalcula_cart();?>
		<div class="checkout-bottom">
			<h3 class="tit-line">YOUR ORDER</h3>
			<table class="table no-style">
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr>
					<td>Sub total</td>
					<td class="value"><?php echo fn_price($cart['subtotal']);?></td>
				</tr>
				<?php if(!empty($cart['coupon_code'])){?>
				<tr>
					<td>Coupon code : <b class="f-red"><?php echo $cart['coupon_code'] ?></b></td>
					<td></td>
				</tr>
				<?php }?>
				<tr>
					<td>Discount</td>
					<td class="value"><?php echo fn_price($cart['discount']) ?></td>
				</tr>
				<tr>
					<td>Delivery To</td>
					<td class="value"><?php echo fn_countries("countries",$country_selected,true);?></td>
				</tr>
				<tr>
					<td>Shipping Fee</td>
					<td class="value"><?php 
						$shipping = fn_shipping($cart['subtotal'],$country_selected);
						echo fn_price($shipping);
						?></td>
				</tr>
				<tr><td colspan="2"><h3 class="tit-line">&nbsp;</h3></td></tr>
				<tr>
					<td>Total</td>
					<td class="value"><?php echo fn_price($cart['total'] - $cart['discount'] + $shipping);?></td> <!-- - $cart['discount'] -->
				</tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr>
					<td></td>
					<td class="float-right"><a class="button style2" href="<?php echo base_url()?>">Continue Shopping</a><a class="button style3" href="<?php echo base_url()?>?cart=rm">Remove Cart</a></td>
				</tr>
			</table>
		</div>
	</div>
	<?php #print_r($cart);?>
<?php include "partials/footer.php";?>