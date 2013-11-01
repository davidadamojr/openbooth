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
					url: "<?php echo site_url('customer/menu/get_menu_items'); ?>",
					data: "type=" + type,
					success: function(data, textStatus){
						$('.menurow').html(data);
						$('.menurow').fadeIn();
						$('.menu-loading').hide();
						menuitem.parent().addClass('active');
					}
				});
			}

			function searchMenu(searchstring){
				//remove the active class from all the list items
				$('.nav li').each(function(index){
					$(this).removeClass('active');
				});

				$('.menu-loading').show();
				$('.menurow').hide();

				$.ajax({
					type: "POST",
					url: "<?php echo site_url('customer/menu/search'); ?>",
					data: "search=" + searchstring,
					success: function(data, textStatus){
						$('.menurow').html(data);
						$('.menurow').fadeIn();
						$('.menu-loading').hide();
					}
				});
			}

			$(document).ready(function(){
				$('#searchbox').keydown(function(e){
					if (e.keyCode == 13){
						searchstring = $('#searchbox').val();
						searchMenu(searchstring);
						return false;
					}
				});
			});
	
		</script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.cycle.all.js'; ?>"></script>
		<script type="text/javascript">
			$('.slide').cycle({
				fx: 'fade'
			});
		</script>
	</head>

	<body>
		<?php echo $menuheader; ?>
		<div class="container-fluid" style="margin-top:120px;">
			<div class="row-fluid">
				<div class="span9" style="">
					<?php if (!empty($featureditem)): ?>
						<div class="rounded-6px" style="background-color:#ffffff;margin-bottom:10px;">
							<div class="row-fluid">
								<div class="featured span7" style="padding:10px;">
									<img src="<?php echo $img_path . $featureditem[0]->picturepath; ?>" width="140" height="140" class="menuimg pull-left img-polaroid" alt="" />
									<span><?php echo $featureditem[0]->name; ?></span>&nbsp;&nbsp;<br/><span><b>$<?php echo $featureditem[0]->price; ?></b></span><br/><br/>
									<a href="#moreinfo-modal" itemid="<?php echo $featureditem[0]->id; ?>" onclick="getMoreInfo(event)" class="btn" data-toggle="modal">More Info</a>
									<br/><br/>
									<a href="#" itemid="<?php echo $featureditem[0]->id; ?>" ingredients="All" itemimg="<?php echo $img_path . $featureditem[0]->picturepath; ?>" onclick="addToOrder(event)" class="btn" itemname="<?php echo $featureditem[0]->name; ?>" price="<?php echo $featureditem[0]->price; ?>"><i class="icon-plus"></i> Add to Order</a>
									&nbsp;&nbsp;
									<a href="#customize-modal" itemimg="<?php echo $img_path . $featureditem[0]->picturepath; ?>" onclick="getIngredients(event)" itemprice="<?php echo $featureditem[0]->price; ?>" itemname="<?php echo $featureditem[0]->name; ?>" itemid="<?php echo $featureditem[0]->id; ?>" class="btn" data-toggle="modal"><i class="icon-wrench"></i> Customize</a>
									<br class="clear" />
								</div>
								<div class="span5 featured_desc" style="">
									<b>Featured Item - <?php echo $featureditem[0]->name; ?></b><p></p>
									<p><?php echo $featureditem[0]->description; ?>
									</p>
								</div>
							</div>
						</div>
					<?php endif; ?>
					<div class="outer-frame rounded-6px">
						<div class="rightmenucol rounded-4px" style="">
							<div class="boxheading toprounded-4px">
								Welcome, <?php echo $this->session->userdata('customername'); ?>
							</div>
							<div class="rightmenucontent">
								<ul class="nav nav-pills">
									<li class="active"><a href="#" onclick="getMenuItems(event)" type="0" class="">Appetizers</a></li>
									<li><a href="#" onclick="getMenuItems(event)" type="1" class="">Main Dish</a></li>
									<li><a href="#" type="2" onclick="getMenuItems(event)" class="">Desserts</a></li>
									<li> <a href="#" type="3" onclick="getMenuItems(event)" class="">Non-alcoholic Drinks</a></li>
									<li><a href="#" type="4" onclick="getMenuItems(event)" class="">Alcoholic Drinks</a></li>
									<li><input id="searchbox" type="text" class="search-query" placeholder="Search" /></li>
								</ul>

								<?php echo $menucontent; ?>			
							</div>
							<!--<br class="clear" /><br/>-->
						</div>
					</div>
					<div class="rounded-6px" style="background-color:#ffffff;margin-top:10px;">
						<div class="row-fluid">
							<div class="span1 newstitle" style="">
								<b>News</b>
							</div>
							<div class="span9 news">
								<div class="slide">
									<?php foreach ($news as $news_item): ?>
										<div><?php echo $news_item['title']; ?></div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php echo $yourorder; ?>
			</div>
			<br/>
		</div>
		<?php echo $moreinfo; ?>
		<?php echo $customize; ?>
		<?php echo $callwaiter; ?>
		<?php echo $drinkrefill; ?>
	</body>
</html>