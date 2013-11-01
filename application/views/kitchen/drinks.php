<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to McDowel's</title>
		<?php echo $dependencies; ?>
	</head>

	<body>
		<?php echo $header; ?>
		<div class="container-fluid" style="margin-top:120px;">
			<div class="row-fluid">
				<div class="span12 outer-frame rounded-6px">
					<div class="whitebg">
						<div class="boxheading toprounded-4px">
							Menu Items
						</div>
						<div class="singlecontent padding-10px">
							<ul class="nav nav-pills">
								<li><a href="<?php echo site_url('kitchen/menuitems'); ?>" class="transition">Food</a></li>
								<li class="active"><a href="<?php echo site_url('kitchen/menuitems/drinks'); ?>" class="transition">Drinks</a></li>
							</ul>
							<?php echo $menucontent; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>