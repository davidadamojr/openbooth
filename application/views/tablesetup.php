<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to OpenBooth</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.css'; ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/boostrap-responsive.css'; ?>">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/main.css'; ?>" />
		<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/validationEngine.jquery.css'; ?>" type="text/css"/>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-1.7.1.min.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/general.js'; ?>"></script>
		<script src="<?php echo base_url() . 'assets/js/jquery.validationEngine-en.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?Php echo base_url() . 'assets/js/jquery.validationEngine.js'; ?>" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#tablesetupform').validationEngine();	
		
			});
		</script>
	</head>

	<body>
		<div class="titlebar" style="margin-bottom: 100px;">
			<span class="title">OpenBooth</span>
		</div>
		<div class="container-fluid">
			<div class="welcome-outer rounded-6px">
				<div class="welcome-inner rounded-4px">
					<h3 style="text-align:center">Table Setup</h3>
					<?php if ($this->session->flashdata('errormsg') != ''): ?>
					    <div class="alert">
						    <button type="button" class="close" data-dismiss="alert">&times;</button>
						    <?php echo $this->session->flashdata('errormsg'); ?>
						</div>
					<?php endif; ?>
					<form class="form-horizontal" id="tablesetupform" method="post" action="<?php echo site_url('tablesetup/setidentity'); ?>">
						<div class="control-group">
							<label class="control-label" for="employeeid">Employee ID</label>
							<div class="controls">
								<input type="password" class="validate[required]" id="employeeid" name="logincode" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="tablenumber">Table Number</label>
							<div class="controls">
								<input type="text" id="tablenumber" class="validate[required, custom[onlyNumberSp]]" name="tablenumber" />
							</div>
						</div>
						<div class="control--group">
							<label class="control-label" for="tabletnumber">Device Number</label>
							<div class="controls">
								<input type="text" id="devicenumber" class="validate[required, custom[onlyNumberSp]]" name="tabletnumber" />
							</div>
						</div>
						<div class="form-actions nobottomspace" style="padding-left:0;text-align:center;background-color:inherit;border-color:#99A2B6">
							<a href="#" onclick="$('#tablesetupform').submit()" class="btn btn-large"><i class="icon-ok"></i> Save</a>
							&nbsp;&nbsp;&nbsp;
							<a href="<?php echo site_url(); ?>" class="btn btn-large transition"><i class="icon-remove"></i> Cancel</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>

</html>