<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to McDowel's</title>
		<?php echo $dependencies; ?>
		<script type="text/javascript">
			$(document).ready(function(){

			});

			function viewOrder(event){
				order = $(event.target);
				$(order.parent().parent()).removeClass('pending');
				orderid = order.attr('orderid');

				$('#btnDelivery').attr('orderid', orderid); //set the orderid attribute of the set to delivery button

				//set the title of the popup (orderdetails)
				$('#tablenumber').html(order.attr('tablenumber'));
				$('#tabletnumber').html(order.attr('tabletnumber'));
				$('#customername').html(order.attr('customername'));

				//get the details of the order
				$('#loading').show();
				$.ajax({
					type: "POST",
					url: "<?php echo site_url('kitchen/orders/getorderdetails'); ?>",
					data: "id=" + orderid + "&status=1",
					success: function(data, textStatus){
						$('#loading').hide();
						$('#orderdetails').html(data);
						$('#orderdetails').show();
					}
				});
			}
		</script>
	</head>

	<body>
		<?php echo $header; ?>
		<div class="container-fluid" style="margin-top:120px;">
			<div class="row-fluid">
				<div class="span12 outer-frame rounded-6px">
					<div class="whitebg">
						<div class="boxheading toprounded-4px">
							Pending Orders
						</div>
						<div class="singlecontent padding-10px">
							<?php if (empty($orders)): ?>
								<div class="alert alert-danger">
									<strong>No pending orders at this time.</strong>
								</div>
							<?php else: ?>
								<?php foreach ($orders as $order): ?>
									<div class="kitchenorder <?php if ($order->status == 0) echo 'pending'; ?>">
										<div class="orderitems pull-left" style="">
											<p><b>Order from <?php echo $order->tablenumber; ?>, Device <?php echo $order->tabletnumber; ?> (<?php echo $order->customername; ?>)</b>
											<br/>
											<b>Ordered Items:</b> 
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
										</div>
										<div class="orderaction pull-right">
											<a orderid="<?php echo $order->id; ?>" tablenumber="<?php echo $order->tablenumber; ?>" customername="<?php echo $order->customername; ?>" tabletnumber="<?php echo $order->tabletnumber; ?>" href="#vieworder-modal" onclick="viewOrder(event)" data-toggle="modal" class="btn btn-large">View Order</a>
										</div>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php echo $orderdetails; ?>
	</body>
</html>