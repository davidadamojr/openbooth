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
				$('#editaccform').validationEngine();
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
							Edit User Account
						</div>
						<div class="singlecontent padding-10px">
							<form class="form-horizontal" method="post" id="editaccform" action="<?php echo site_url('manager/useraccounts/edit/' . $useraccount->id); ?>">
								<!--<div class="control-group">
									<label class="control-label" for="employeeid">Employee ID</label>
									<div class="controls">
										<input type="text" class="validateuneditable-input" id="employeeid" name="employeeid" value="123456" />
									</div>
								</div>-->
								<div class="control-group">
									<label class="control-label" for="firstname">First Name</label>
									<div class="controls">
										<input type="text" value="<?php echo $useraccount->fname; ?>" id="fname" name="fname" class="validate[required, custom[onlyLetterSp]]" placeholder="First Name">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="lname">Last Name</label>
									<div class="controls">
										<input type="text" value="<?php echo $useraccount->lname; ?>" id="lname" name="lname" class="validate[required, custom[onlyLetterSp]]" placeholder="Last Name" />
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="accounttype">Account Type</label>
									<div class="controls">
										<select name="role" class="validate[required]">
											<option value="">Select Account Type</option>
											<option <?php if ($useraccount->role == 0) echo 'selected'; ?> value="0">Wait Staff</option>
											<option <?php if ($useraccount->role == 1) echo 'selected'; ?> value="1">Kitchen</option>
											<option <?php if ($useraccount->role == 2) echo 'selected'; ?> value="2">Manager</option>
										</select>
									</div>
								</div>
								<div class="form-actions" style="margin-bottom:0;">
									<a href="#" onclick="$('#editaccform').submit()" class="btn btn-large">Save Changes</a>
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