<script type="text/javascript">
	function callWaiter(event){
		type = 0;
		$.post("<?php echo site_url('customer/notifications/callwaiter'); ?>", "type=" + type);
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
			    	<a href="<?php echo site_url('customer/menu'); ?>" class="btn btn-large btn-inverse transition"><i class="icon-hand-left icon-white"></i> Back to Menu</a>
			    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			    	<a href="#callwaiter-modal" onclick="callWaiter(event)" data-toggle="modal" class="btn btn-large btn-inverse"><i class="icon-user icon-white"></i> Call a Waiter</a>
			    	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			    	<!--<input type="text" class="search-query" placeholder="Search" />-->
			    </form>
			</div>
		</div>
	</div>
</div>