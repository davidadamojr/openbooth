<script type="text/javascript">
	function callWaiter(event){
		type = 0;
		$.post("<?php echo site_url('customer/notifications/callwaiter'); ?>", "type=" + type);
	}

	function requestDrinkRefill(event)
	{
		type = 1;
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('customer/notifications/drinkrefill'); ?>",
			data: "type=" + type,
			success: function(data, textstatus){
				if (data == '1'){
					$('#drinkrefillsuccess').show();
					$('#drinkrefillfail').hide();
				} else {
					$('#drinkrefillsuccess').hide();
					$('#drinkrefillfail').show();
				}
			}
		});
	}
</script>	
<div class="mainheader navbar-fixed-top">
	<div class="titlebar">
		<span class="title">McDowel's OpenBooth</span>
	</div>
	<div class="navbar">
		<div class="navbar-inner">
			<div class="">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>

			    <form class="navbar-form pull-left" style="margin-left:16px;">
			    	<a href="<?php echo site_url('customer/menu/customer_exit'); ?>" class="btn btn-large btn-inverse transition"><i class="icon-hand-left icon-white"></i> Exit</a>
			    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			    	<a href="#callwaiter-modal" onclick="callWaiter(event)" data-toggle="modal" class="btn btn-large btn-inverse"><i class="icon-user icon-white"></i> Call a Waiter</a>
			    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			    	<a href="#refill-modal" onclick="requestDrinkRefill(event)" data-toggle="modal" class="btn btn-large btn-inverse"><i class="icon-glass icon-white"></i> Drink Refill</a>
			    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			    	<a href="<?php echo site_url('customer/payment'); ?>" class="btn btn-large btn-inverse transition"><i class="icon-shopping-cart icon-white"></i> Make Payments</a>
			    </form>
			</div>
		</div>
	</div>
</div>