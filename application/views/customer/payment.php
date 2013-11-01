<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to McDowel's</title>
		<?php echo $dependencies; ?>
		<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/validationEngine.jquery.css'; ?>" type="text/css"/>
		<script src="<?php echo base_url() . 'assets/js/jquery.validationEngine-en.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo base_url() . 'assets/js/jquery.validationEngine.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#paymentform').validationEngine();

				itemsPaidFor = "";

				taxRate = 0.08;
				totalPrice = <?php echo $values->total; ?>;
				taxAmount = <?php echo $values->tax; ?>;
				subTotal = <?php echo $values->subtotal; ?>;

				$('.itemordered').each(function(index){
					if ($(this).attr('checked')){
						if (itemsPaidFor == ""){
							itemsPaidFor = itemsPaidFor + $(this).attr('orderid');
						} else { 
							itemsPaidFor = itemsPaidFor + "," + $(this).attr('orderid');
						}
					}
				});

				$('.itemordered').click(function(e){
					itemsPaidFor = "";
					subTotal = 0.00;
					totalPrice = 0.00;
					taxAmount = 0.00;

					//set the coupon used flag back to zero since all coupons redeemed would be reset
					$('input[name=couponused').val('0');
					//remove any alerts about coupon codes
					$('#invalidcode').hide();
					$('#codesuccess').hide();
					
					$('.itemordered').each(function(index){
						if ($(this).attr('checked')){
							if (itemsPaidFor == ""){
								itemsPaidFor = itemsPaidFor + $(this).attr('orderid');
								subTotal = subTotal + parseFloat($(this).attr('price'));
							} else { 
								itemsPaidFor = itemsPaidFor + "," + $(this).attr('orderid');
								subTotal = subTotal + parseFloat($(this).attr('price'));
							}
						}
					});
					//alert(itemsPaidFor);
					$('input[name=ordereditems]').val(itemsPaidFor);
					//alert($('input[name=ordereditems]').val());

					taxAmount = (taxRate * subTotal).toFixed(2);
					totalPrice = (totalPrice + subTotal).toFixed(2);
					subTotal = subTotal.toFixed(2);

					//update subtotal
					$('#subtotalamount').html(subTotal);

					//update taxamount
					$('#taxamount').html(taxAmount);
					$('input[name=tax]').val(taxAmount);

					//update total
					$('input[name=total]').val(totalPrice);
					$('#totalamount').html(totalPrice);
				});
			});

			function redeemCode()
			{
				code = $('input[name=couponcode]').val();
				if (code == '')
					return;

				$.ajax({
					type: "POST",
					url: "<?php echo site_url('customer/payment/redeemcode'); ?>",
					data: "code=" + code,
					success: function(data, textstatus){
						if (data == '1'){
							//coupon code is valid
							$('#invalidcode').hide();
							$('#codesuccess').slideDown('fast');

							subTotal = subTotal * 0.9;
							subTotal = subTotal.toFixed(2);

							taxAmount = parseFloat(subTotal) * taxRate
							taxAmount = taxAmount.toFixed(2);

							totalPrice = parseFloat(subTotal) + parseFloat(taxAmount);
							totalprice = totalPrice.toFixed(2);

							//update values in DOM

							//update subtotal
							$('#subtotalamount').html(subTotal);

							//update taxamount
							$('#taxamount').html(taxAmount);
							$('input[name=tax]').val(taxAmount);

							//update total
							$('input[name=total]').val(totalPrice);
							$('#totalamount').html(totalPrice);

							//set the coupon used flag to 1
							$('input[name=couponused]').val('1');
						} else {
							//coupon code is invalid
							$('#codesuccess').hide(); 
							$('#invalidcode').slideDown('fast');
						}
					}
				});
			}

			function sendCashNotification(event){
				$.ajax({

				});
			}
		</script>
	</head>

	<body>
		<?php echo $paymentheader; ?>
		<div class="container-fluid" style="margin-top:120px;">
			<div class="row-fluid">
				<div class="span3 outer-frame rounded-6px">
					<div class="rounded-4px paymentorder">
						<div class="boxheading toprounded-4px">
							Your Order
						</div>
						<div class="paymentordercontent">
							<p class="contentbox">Please select the items you want to pay for.</p>
							<?php foreach ($unpaid_items as $unpaid_item): ?>
								<div class="ordereditem">
									<input price="<?php echo $unpaid_item->price; ?>" orderid="<?php echo $unpaid_item->id; ?>" class="itemordered pull-left" style="margin-right:15px;" type="checkbox" name="order" checked />
									&nbsp;&nbsp;
									<div class="ordered pull-left" style=""><?php echo $unpaid_item->name; ?><br/><b>$<?php echo $unpaid_item->price; ?></b></div>
								</div>
							<?php endforeach; ?>
						</div>
						
					</div>
				</div>
				<div class="span6 outer-frame rounded-6px">
					<div class="paymentmain rounded-4px" style="">
						<div class="boxheading toprounded-4px">
							Payment Details
						</div>
						<div class="paymentdetails">
							<div class="alert alert-danger hide" id="invalidcode">
								<strong>The coupon code you provided is invalid.</strong>
							</div>
							<div class="alert alert-success hide" id="codesuccess">
								<strong>Your coupon code is valid. Your payment amounts have been updated.</strong>
							</div>
							<form method="post" action="<?php echo site_url('customer/payment/success'); ?>" id="paymentform">
								<p>
									<table class="form">
										<tr>
											<td class="formlabel">Subtotal</td>
											<td>$<span id="subtotalamount"><?php echo $values->subtotal; ?></span></td>
										</tr>
										<tr>
											<td class="formlabel">Tax</td>
											<td>$<span id="taxamount"><?php echo $values->tax; ?></span> <input type="hidden" value="<?php echo $values->tax; ?>" name="tax" /></td>
										</tr>
										<tr>
											<td class="formlabel">Tip</td>
											<td>$ <input name="tipamount" value="0.00" type="text" class="span3" /></td>
										</tr>
										<tr>
											<td class="formlabel">Total</td>
											<td>$<span id="totalamount"><?php echo $values->total; ?></span> <input name="total" type="hidden" value="<?php echo $values->total; ?>" /></td>
										</tr>
										<tr>
											<td class="formlabel">Payment Type</td>
											<td><a href="#" onclick="$('#creditpayment').show();" class="btn">Credit/Debit Card</a>&nbsp;&nbsp;<a href="#cash-modal" onclick="callWaiter(event); $('#creditpayment').slideUp('fast');" data-toggle="modal" class="btn">Cash</td>
										</tr>
										<tr>
											<td class="formlabel">Coupon Code</td>
											<td><input type="password" class="span5" name="couponcode" /><br/><a href="#" onclick="redeemCode()" class="btn">Redeem</a></td>
										</tr>
									</table>
									<br/>
									<table class="form" id="creditpayment">
										<tr>
											<td class="formlabel">Card Number</td>
											<td><input type="text" class="span12 validate[required]" name="cardnumber" /></td>
										</tr>
										<tr>
											<td class="formlabel">Expiry Date</td>
											<td><input type="text" class="span6 validate[required]" name="expirydate" /></td>
										</tr>
										<tr>
											<td class="formlabel">CVV</td>
											<td><input type="text" class="span4 validate[required]" name="cvvnumber" /></td>
										</tr>
									</table>
									<input type="hidden" value="<?php echo $unpaid_ids; ?>" name="ordereditems" />
									<input type="hidden" value="0" name="couponused" />
								</p>
								<a href="#" class="btn btn-large" onclick="$('#paymentform').submit()"><i class="icon-shopping-cart"></i> Make Payment</a>
							</form>
						</div>
					</div>
				</div>
				<div class="span3 outer-frame rounded-6px">
					<div class="wincoupon rounded-4px" style="">
						<div class="boxheading toprounded-4px">
							Win a Coupon!
						</div>
						<div class="wincouponcontent">
							<p>Did you enjoy your meal at McDowel's? Do you want a free coupon? Click the button below 
							to get a chance at a free 10% discount coupon!</p>
							<a href="#game-modal" data-toggle="modal" class="btn btn-large"><i class="icon-gift"></i> Play Game</a>
						</div>
					</div>
				</div>
			</div>
			<br/>
		</div>
		<?php echo $callwaiter; ?>
		<?php echo $cashpayment; ?>
		<?php echo $game; ?>
	</body>

</html>