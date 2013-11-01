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
				$('#createaccform').validationEngine();
			});	
		</script>
	</head>

	<body>
		<?php echo $header; ?>
		<div class="container-fluid" style="margin-top:120px;">
			<div class="row-fluid">
				<div class="span12 outer-frame rounded-6px">
					<div class="whitebg">
						<div class="boxheading toprounded-4px" style="">
							Create User Account
						</div>
						<div class="singlecontent padding-10px">
							<form class="form-horizontal" method="post" id="createaccform" action="<?php echo site_url('manager/useraccounts/create'); ?>">
								<!--<div class="control-group">
									<label class="control-label" for="employeeid">Employee ID</label>
									<div class="controls">
										<input type="text" class="validateuneditable-input" id="employeeid" name="employeeid" value="123456" />
									</div>
								</div>-->
								<div class="control-group">
									<label class="control-label" for="firstname">First Name</label>
									<div class="controls">
										<input type="text" id="fname" name="fname" class="validate[required, custom[onlyLetterSp]]" placeholder="First Name">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="lastname">Last Name</label>
									<div class="controls">
										<input type="text" id="lname" name="lname" class="validate[required, custom[onlyLetterSp]]" placeholder="Last Name" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="role">Account Type</label>
									<div class="controls">
										<select name="role" class="validate[required]">
											<option value="">Select Account Type</option>
											<option value="0">Wait Staff</option>
											<option value="1">Kitchen</option>
											<option value="2">Manager</option>
										</select>
									</div>
								</div>
								<div class="form-actions" style="margin-bottom:0;">
									<a href="#" onclick="$('#createaccform').submit()" class="btn btn-large">Create Account</a>
									&nbsp;&nbsp;
									<a href="<?php echo site_url('manager/useraccounts'); ?>" class="btn btn-large transition">Cancel</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>