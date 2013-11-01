<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to OpenBooth</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.css'; ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/boostrap-responsive.css'; ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/main.css'; ?>" />
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.7.1.min.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/general.js'; ?>"></script>
	</head>

	<body>
		<div class="titlebar" style="margin-bottom: 100px;">
			<span class="title">OpenBooth</span>
		</div>
		<div class="container-fluid">
			<div class="welcome-outer rounded-6px">
				<div class="welcome-inner rounded-4px">
					<p style="text-align:center;">Welcome to <i>OpenBooth</i>. <i>OpenBooth</i> is exactly what you need to make your restaurant 
						more efficient.</p> 
					<h4 style="text-align:center;">Please pick a section!</h4>
					<div class="menubuttons">
						<table id="mainmenu">
							<tr>
								<td><a href="<?php echo site_url('customer'); ?>" class="mainbtn btn btn-inverse btn-large transition">Customer</a></td>
								<td><a href="<?php echo site_url('waiter'); ?>" class="mainbtn btn btn-large btn-inverse transition">Waiter</a></td>
							</tr>
							<tr>
								<td><a href="<?php echo site_url('kitchen'); ?>" class="mainbtn btn btn-large btn-inverse transition">Kitchen</a></td>
								<td><a href="<?php echo site_url('manager'); ?>" class="mainbtn btn btn-large btn-inverse transition">Manager</a></td>
							</tr>
							<tr>
								<td><a href="<?php echo site_url('tablesetup'); ?>" class="mainbtn btn btn-large btn-inverse transition">Table Setup</a></td>
								<td>&nbsp;</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</body>

</html>