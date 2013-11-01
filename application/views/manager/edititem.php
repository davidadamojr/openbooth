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
				$('#menuitemform').validationEngine();
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
							Add Menu Item
						</div>
						<div class="singlecontent padding-10px">
							<form id="menuitemform" class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('manager/menuitems/edit/' . $menuitem->id); ?>">
								<div style="margin-bottom:25px;overflow:auto;">
									<table class="form pull-left" style="width:50%;margin-right:20px;">
										<tbody>
											<tr>
												<td class="formlabel label20">Name</td>
												<td><input class="validate[required]" value="<?php echo $menuitem->name; ?>" type="text" name="name" /></td>
											</tr>
											<tr>
												<td class="formlabel label20">Description</td>
												<td><textarea class="validate[required]" name="description"><?php echo $menuitem->description; ?></textarea></td>
											</tr>
											<tr>
												<td class="formlabel label20">Price</td>
												<td><input type="text" value="<?php echo $menuitem->price; ?>" name="price" class="span3 validate[required]" /></td>
											</tr>
											<tr>
												<td class="formlabel label20">Calories Count</td>
												<td><input type="text" value="<?php echo $menuitem->calories; ?>" name="calories" class="span2 validate[required, custom[onlyNumberSp]]" /></td>
											</tr>
											<tr>
												<td class="formlabel label20">Optional Ingredients (comma separated)</td>
												<td><input type="text" value="<?php echo $menuitem->keywords; ?>" name="ingredients" class="span10" /></td>
											</tr>
											<tr>
												<td class="formlabel label20">Picture Upload</td>
												<td><input type="file" name="userfile" /></td>
											</tr>
											<tr>
												<td class="formlabel label20">Item Type</td>
												<td>
													<select name="type" class="validate[required]">
														<option value="">Select Item Type</option>
														<option <?php if ($menuitem->available == 0) echo 'selected'; ?> value="0">Appetizer</option>
														<option <?php if ($menuitem->available == 1) echo 'selected'; ?> value="1">Main Dish</option>
														<option <?php if ($menuitem->available == 2) echo 'selected'; ?> value="2">Dessert</option>
														<option <?php if ($menuitem->available == 3) echo 'selected'; ?> value="3">Non-alcoholic Drink</option>
														<option <?php if ($menuitem->available == 4) echo 'selected'; ?> value="4">Alcoholic Drink</option>
													</select>
												</td>
											</tr>
											<tr>
												<td class="formlabel label20">Availability</td>
												<td>
													<select name="available">
														<option <?php if ($menuitem->available == 1) echo 'selected'; ?> value="1" selected>Yes</option>
														<option <?php if ($menuitem->available == 0) echo 'selected'; ?> value="0">No</option>
													</select>
												</td>
											</tr>
										</tbody>
									</table>
									<img class="img-polaroid menuimg" src="<?php if ($menuitem->picturepath == null || $menuitem->picturepath == '') echo base_url() . 'assets/img/140x140.gif'; else echo base_url() . 'assets/dishes/' . $menuitem->picturepath; ?>" />
								</div>
								<br class="clear" />
								<div class="form-actions">
									<a href="#" onclick="$('#menuitemform').submit()" class="btn btn-large">Add Menu Item</a>
									&nbsp;&nbsp;
									<a href="<?php echo site_url('manager/menuitems'); ?>" class="btn btn-large transition">Cancel</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>