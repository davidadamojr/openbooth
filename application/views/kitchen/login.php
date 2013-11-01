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
				$('#loginform').validationEngine();
			});	

			function userLogin(){
				logincode = $('input[name=logincode]').val();
				if (logincode == ''){
					return;
				}

				role = $('input[name=role]').val();

				$('#loading').show();
				//send ajax request for authentication
				$.ajax({
					type: "POST",
					url: "<?php echo site_url('user/authenticate'); ?>",
					data: "logincode=" + logincode + "&role=" + role,
					success: function(data, textStatus){
						$('#loading').hide();
						if (data == '1'){
							//login successful
							window.location.href = "<?php echo site_url('kitchen/orders'); ?>";
						} else {
							//login failed
							$('#loginfailed').slideDown('fast');
							setTimeout("$('#loginfailed').slideUp('fast')", 5000);
						}
					}
				});

				return false;
			}
		</script>
	</head>

	<body>
		<div class="titlebar" style="margin-bottom: 100px;">
			<span class="title">McDowel's OpenBooth</span>
		</div>
		<div class="container-fluid">
			<div class="welcome-outer rounded-6px">
				<div class="whitebg rounded-4px">
					<div class="boxheading toprounded-4px">
						Kitchen Login
					</div>
					<div class="padding-10px">
						<div class="alert alert-danger hide" id="loginfailed">
							<strong>Login failed!</strong>
						</div>
						<p>Please enter your employee ID in the text field below.</p>
						<br/>
						<form onsubmit="userLogin(); return false;" id="loginform" action="<?php echo site_url('kitchen/authenticate'); ?>" method="post" style="margin-bottom:0;">
							<input type="password" class="validate[required, custom[onlyNumberSp], maxSize[6], minSize[6]]" name="logincode" />
							<input type="hidden" name="role" value="1" />
						</form>
					</div>
					<div class="form-actions" style="margin-bottom: 0;">
						<a href="#" onclick="$('#loginform').submit()" class="btn btn-large"><i class="icon-ok"></i> Login</a>
						&nbsp;&nbsp;
						<img src="<?php echo base_url() . 'assets/img/loading.gif'; ?>" class="loading hide"/>
					</div>
				</div>
			</div>
		</div>
	</body>

</html>