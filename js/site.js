$(window).load(function(){
	$('.grid').masonry({
		itemSelector: '.gridItem',
		percentPosition: true
  });
});

$('.ajax-country select').change(function(){
	$url = $(this).attr('ajax-url');
	$country = $(this).val();
	$.ajax({
		url:$url,
		type:"POST",
		data:{country:$country},
		success:function(data){
			location.reload();
		}
	});
});



$('#apply_coupon').click(function(){
	$url = $(this).attr('ajax-url');
	$coupon_code = $("#coupon_code").val();
	$.ajax({
		url:$url,
		type:"POST",
		data:{coupon_code:$coupon_code},
		success:function(data){
			location.reload();
		}
	});
});

//add to cart
//add-to-cart
//form[ajax]
//event.preventDefault();
$('form[ajax]').submit(function(event){
	event.preventDefault();
	$form = $(this);
	$url = $form.attr('action');
	$product_id = $form.find('[name="product_id"]').val();
	$quantity =  $form.find('[name="quantity"]').val();
	$.ajax({
		url:$url,
		type:"POST",
		data:{product_id:$product_id,quantity:$quantity},		
		success:function(data){
			//console.log(data);
			location.href=$url;
		}
	});
	return false;
})