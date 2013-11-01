<script type="text/javascript">
	ordertotal = 0;

	function selectIngredient(event){
		var count = 0;
		$('#customizeAddbtn').attr('ingredients', '');
		$('.ingr_box').each(function(index){
			if ($(this).attr('checked')){
				if (count == 0)
					ingredients = $('#customizeAddbtn').attr('ingredients') + $(this).attr('ingrname');
				else	
					ingredients = $('#customizeAddbtn').attr('ingredients') + ',' + $(this).attr('ingrname');
				$('#customizeAddbtn').attr('ingredients', ingredients);
				count = count + 1;
			}
		});
	}

	function getMoreInfo(event){
		itemid = $(event.target).attr('itemid');
		$('.moreinfo-loading').show();
		$('#moreinfo').hide();
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('customer/menu/moreinfo'); ?>",
			data: "id=" + itemid,
			success: function(data, textStatus){
				$('.moreinfo-loading').hide();
				$('#moreinfo').html(data);
				$('#moreinfo').show();
			}
		});
	}

	function addToOrder(event){
		item = $(event.target);
		itemprice = item.attr('price');
		ordertotal = ordertotal + parseFloat(itemprice);
		$('#ordertotal').html('');
		$('#ordertotal').html('$' + ordertotal);

		//add the item to the order list
		itemname = item.attr('itemname');
		itemimg = item.attr('itemimg');
		itemid = item.attr('itemid');
		ingredients = item.attr('ingredients');

		item_markup = "<div ingredients='" + ingredients + "' price='" + itemprice + "' itemid='" + itemid + "' class='ordereditem'><img src='" + itemimg + "' width='100' height='100' class='img-polaroid pull-left menuimg'><span class='ordered'>" + itemname + "<br/><b>$" + itemprice + "</b></span><br/><br/><a href='#' itemprice='" + itemprice + "' onclick='removeFromOrder(event)' class='btn'><i class='icon-remove'></i> Remove</a></div>";
		$('div.items').append(item_markup)
	}

	function removeFromOrder(event){
		item = $(event.target);
		itemprice = item.attr('itemprice');
		item.parent().remove();

		ordertotal = ordertotal - parseFloat(itemprice);
		$('#ordertotal').html('');
		$('#ordertotal').html('$' + ordertotal);
	}

	function getIngredients(event)
	{
		item = $(event.target);
		itemid = item.attr('itemid');
		itemname = item.attr('itemname');
		itemprice = item.attr('itemprice');
		itemimg = item.attr('itemimg');

		$('#mealname').html(itemname);

		$('#customizeAddbtn').attr('itemname', itemname);
		$('#customizeAddbtn').attr('price', itemprice);
		$('#customizeAddbtn').attr('itemimg', itemimg);
		$('#customizeAddbtn').attr('itemid', itemid);

		$.ajax({
			type: "POST",
			url: "<?php echo site_url('customer/menu/getingredients'); ?>",
			data: "menuitemid=" + itemid,
			success: function(data, textStatus){
				$('#ingr_list').html(data);
				$('#ingr_list').show();
				$('.ingr-loading').hide();
			}
		});
	}

	function ordereditem(menuid, ingredients, price)
	{
		//ordereditem object
		this.menuid = menuid;
		this.ingredients = ingredients;
		this.price = price;
	}

	function placeOrder()
	{
		//make sure items have been selected
		ordereditems = new Array();
		$('.ordereditem').each(function(index){
			item = new ordereditem($(this).attr('itemid'), $(this).attr('ingredients'), $(this).attr('price'));
			ordereditems.push(item);
		});

		if (ordereditems.length == 0){
			return;
		}

		JSONitems = JSON.stringify(ordereditems);
		//alert(JSONitems); return;
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('customer/menu/placeorder'); ?>",
			data: "ordereditems=" + JSONitems,
			success: function(){
				$('#orderplaced').slideDown('fast');
				$('.items').html('');
				ordertotal = 0;
				$('#ordertotal').html('');
				$('#ordertotal').html('$' + ordertotal);
			}
		});
	}
</script>
<div class="menuitems">
	<div id="loading" class="hide menu-loading"><img src="<?php echo base_url() . 'assets/img/loading.gif'; ?>" /></div>
	<div class="alert alert-success hide" id="orderplaced">
		<!--<button type="button" class="close" data-dismiss="alert">&times;</button>-->
		You have successfully placed an order. Your order is now <span id="orderstatus"><strong>being prepared.</strong></span>
	</div>
	<?php if ($this->session->flashdata('outstanding_msg') != ''): ?>
		<div class="alert alert-danger" id="outstanding_alert">
			<?php echo $this->session->flashdata('outstanding_msg'); ?>
		</div>
	<?php endif; ?>
	<div class="row-fluid menurow" style="">
		<?php $index = 0;
		foreach ($menuitems as $menuitem): ?>
			<div class="span6 menuitem" style="<?php if ($index % 2 == 0) echo 'margin-left:0'; ?>">
				<?php if ($menuitem->picturepath == '' || $menuitem->picturepath == null): ?>
					<img src="<?php echo base_url() . 'assets/img/140x140.gif'; ?>" width="140" height="140" class="menuimg pull-left img-polaroid" alt="<?php echo $menuitem->name; ?>" />
				<?php else: ?>
					<img src="<?php echo $img_path . $menuitem->picturepath; ?>" width="140" height="140" class="menuimg pull-left img-polaroid" alt="<?php echo $menuitem->name; ?>" />
				<?php endif; ?>
				<span><?php echo $menuitem->name; ?></span>&nbsp;&nbsp;<br/><span><b>$<?php echo $menuitem->price; ?></b></span><br/><br/>
				<a href="#moreinfo-modal" itemid="<?php echo $menuitem->id; ?>" onclick="getMoreInfo(event)" class="btn" data-toggle="modal"><?php if ($menuitem->calories < 1000) echo "<i class='icon-heart'></i>"; ?> More Info</a>
				<br/><br/>
				<a href="#" itemid="<?php echo $menuitem->id; ?>" ingredients="All" itemimg="<?php echo $img_path . $menuitem->picturepath; ?>" onclick="addToOrder(event)" class="btn" itemname="<?php echo $menuitem->name; ?>" price="<?php echo $menuitem->price; ?>"><i class="icon-plus"></i> Add to Order</a>
				&nbsp;&nbsp;
				<a href="#customize-modal" itemimg="<?php echo $img_path . $menuitem->picturepath; ?>" onclick="getIngredients(event)" itemprice="<?php echo $menuitem->price; ?>" itemname="<?php echo $menuitem->name; ?>" itemid="<?php echo $menuitem->name; ?>" class="btn" data-toggle="modal"><i class="icon-wrench"></i> Customize</a>
			</div>
			<?php $index = $index + 1; ?>
		<?php endforeach; ?>
	</div>
</div>