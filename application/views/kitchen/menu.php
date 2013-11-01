<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to McDowel's</title>
		<?php echo $dependencies; ?>
		<script type="text/javascript">
			function getMenuItems(event){
				menuitem = $(event.target);
				type = menuitem.attr('type');

				//remove the active class from all the list items
				$('.nav li').each(function(index){
					$(this).removeClass('active');
				});

				$('.menu-loading').show();
				$('.menurow').hide();

				$.ajax({
					type: "POST",
					url: "<?php echo site_url('kitchen/menuitems/get_menu_items'); ?>",
					data: "type=" + type,
					success: function(data, textStatus){
						$('.menurow').html(data);
						$('.menurow').fadeIn();
						$('.menu-loading').hide();
						menuitem.parent().addClass('active');
					}
				});
			}
		</script>
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
								<li class="active"><a type="0" href="#" onclick="getMenuItems(event)" class="">Appetizers</a></li>
								<li><a type="1" onclick="getMenuItems(event)" href="#" class="">Main Dish</a></li>
								<li><a type="2" onclick="getMenuItems(event)" href="#" class="">Desserts</a></li>
								<li> <a type="3" onclick="getMenuItems(event)" href="#" class="">Non-alcoholic Drinks</a></li>
								<li><a type="4" onclick="getMenuItems(event)" href="#" class="">Alcoholic Drinks</a></li>
							</ul>
							<?php echo $menucontent; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>