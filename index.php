<?php 
$title = "Products";
include "partials/header.php";

if(!empty($_GET['cart'])){
	if($_GET['cart'] == 'rm'){
		unset($_SESSION['cart']);
		header('Location: '.base_url());
	}
}


#unset($_SESSION['cart']);
?>
	<div class="main">
		<ul class="grid grid4">
			<?php foreach($products as $product_id=>$p):?>
			<li class="item gridItem">
				<form ajax method="POST" action="<?php echo site_uri('checkout.php')?>">
				<input type="hidden" value="<?php echo $product_id?>" name="product_id" />
				<div class="product-image"><img src="<?php echo fn_image_thumb($p['image']);?>" /></div>
				<div class="product-info">
					<div class="product-brand"><?php echo $p['brand']?></div>
					<div class="product-name"><?php echo $p['product_name']?></div>
				</div>
				<div class="list-price">
					<?php echo fn_sell_price($p['selling_price']);?>
					<?php if(!empty($p['retail_price'])):?>
					<?php echo fn_retail_price($p['retail_price']);?>
					<?php endif;?>
				</div>
				<div class="add-to-cart">
					<?php echo quantity_select($p['product_code'],$p['quantity']);?>
					<button class="button" class="add-to-cart">BUY NOW</button>
				</div>
				</form>
			</li>
			<?php endforeach;?>
		</ul>
	</div>
<?php include "partials/footer.php";?>