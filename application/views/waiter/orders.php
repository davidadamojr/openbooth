<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to McDowel's</title>
		<?php echo $dependencies; ?>
		<script src="<?php echo base_url() . 'assets/js/jquery.validationEngine-en.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?Php echo base_url() . 'assets/js/jquery.validationEngine.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/validationEngine.jquery.css'; ?>" type="text/css"/>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#paymentform').validationEngine();	
			});

			function setAsDelivered(event){
				order = $(event.target);
				orderid = order.attr('orderid');
				if (!order.hasClass('disabled')){
					$.ajax({
						type: "POST",
						url: "<?php echo site_url('waiter/orders/setasdelivered'); ?>",
						data: "id=" + orderid + "&status=" + 3,
						success: function(data, textStatus){
							order.parent().parent().fadeOut();
						}
					});
				}
			}

			function compItem(event)
			{
				item = $(event.target);
				itemid = item.attr('itemid');
				price = $('#price_' + itemid).val();

				$.ajax({
					type: "POST",
					url: "<?php echo site_url('waiter/orders/compitem'); ?>",
					data: "id=" + itemid + "&price=" + price,
					success: function(data, textStatus){
						$('#compsuccess').slideDown();
						setTimeout("$('#compsuccess').slideUp()", 4000);
					}
				});
			}

			function makeCashPayment(event)
			{
				order = $(event.target);
				orderid = order.attr('orderid');
				$('input[name=order]').val(orderid);
			}

			function getOrderDetails(event)
			{
				$('#loading').show();
				$('#itemstocomp').hide();
				orderid = $(event.target).attr('orderid');

				$.ajax({
					type: "POST",
					url: "<?php echo site_url('waiter/orders/getorderitems'); ?>",
					data: "orderid=" + orderid,
					success: function(data, textstatus){
						$('#loading').hide();
						$('#itemstocomp').html(data);
						$('#itemstocomp').show();
					}
				});
			}

			function setOrderId(event)
			{
				$('#orderid').html($(event.target).attr('orderid'));
				$('input[name=orderid]').val($(event.target).attr('orderid'));
			}
		</script>
	</head>

	<body>
		<?php echo $header; ?>
		<div class="container-fluid" style="margin-top:120px;">
			<div class="row-fluid">
				<div class="span12 outer-frame rounded-6px">
					<div class="whitebg">
						<div class="boxheading toprounded-4px" style="padding-bottom:15px;">
							Pending Orders
							<a href="<?php echo site_url('customer'); ?>" class="btn pull-right transition" style="margin-right:14px;">Make Order</a>
						</div>
						<div class="singlecontent padding-10px">
							<?php if ($this->session->flashdata('successmsg') != ''): ?>
								<div class="alert alert-success" style="width:50%">
									<button type="button" class="close" data-dismiss="alert">x</button>
									<strong>Payment successful!</strong>
								</div>
							<?php endif; ?>

							<?php if (empty($orders)): ?>
								<div class="alert alert-danger">
									There are no pending orders at this time.
								</div>
							<?php endif; ?>

							<?php foreach ($orders as $order): ?>
								<div class="kitchenorder">
									<div class="orderitems pull-left" style="">
										<div class="tablenumber rounded-4px pull-left">
											<?php echo $order->tablenumber; ?>
										</div>
										<p class="pull-right"><b>Ordered Items:</b>
											<?php
												$ordereditems = $order->getOrderedItems();
												$count = 0;
												foreach ($ordereditems as $ordereditem){
													if ($count != 0 && $count != count($ordereditems))
														echo ', ';
													echo $ordereditem->itemname;
													$count = $count + 1;
												}
											?>
											<br/>
											Table <?php echo $order->tablenumber; ?>, Device <?php echo $order->tabletnumber; ?> (<?php echo $order->customername; ?>)<br/>
											<b>
												<?php 
												if ($order->status == 1) echo "Being prepared"; else if ($order->status==2) echo "Ready for Delivery";
												?>
												<?php 
												if ($order->checkPaymentComplete()) echo ", Payment completed";
												?>
											</b>
										</p>
									</div>
									<div class="orderaction pull-right">
										<a href="#" onclick="setAsDelivered(event)" orderid="<?php echo $order->id; ?>" class="btn btn-large">Set as Delivered</a>
										&nbsp;&nbsp;
										<a href="#comp-modal" onclick="getOrderDetails(event)" orderid="<?php echo $order->id; ?>" data-toggle="modal" class="btn btn-large">Comp</a>
										&nbsp;&nbsp;
										<a href="#payment-modal" onclick="setOrderId(event)" orderid="<?php echo $order->id; ?>" data-toggle="modal" class="btn btn-large">Make Payment</a>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php echo $comporder; ?>
		<?php echo $makepayment; ?>
	</body>
</html>