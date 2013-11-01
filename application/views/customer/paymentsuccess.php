<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to McDowel's</title>
		<?php echo $dependencies; ?>
	</head>

	<body>
		<div class="titlebar" style="margin-bottom: 100px;">
			<span class="title">McDowel's OpenBooth</span>
		</div>
		<div class="container-fluid">
			<div class="welcome-outer rounded-6px">
				<div class="whitebg rounded-4px">
					<div class="boxheading toprounded-4px">
						Payment Successful
					</div>
					<div class="padding-10px">
						<p>Your payment was successful. You have $<?php if ($outstanding > 0) echo $outstanding; else echo '0.00'; ?> outstanding payments.</p>
						<p><a href="#receipt-modal" data-toggle="modal" class="btn">View Receipt</a></p><br/>
						<p>What do you want to do next?</p>
						<div class="form-actions" style="margin-bottom:0;">
							<a href="<?php echo site_url('customer/menu'); ?>" class="btn transition"><i class="icon-arrow-left"></i> Back to menu</a>
							<?php if ($outstanding > 0): ?>
								&nbsp;&nbsp;<a href="<?php echo site_url('customer/payment'); ?>" class="btn transition"><i class="icon-shopping-cart"></i> Make Another Payment</a>
							<?php endif; ?>
							&nbsp;&nbsp;<a href="<?php echo site_url('customer/menu/customer_exit'); ?>" class="btn"><i class="icon-off"></i> Exit</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php echo $receipt; ?>
	</body>

</html>