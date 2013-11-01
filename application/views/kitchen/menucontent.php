<script type="text/javascript">
	function makeUnavailable(event)	{
		menuitem = $(event.target);
		menuitemid  = menuitem.attr('menuitemid');

		$.ajax({
			type: "POST",
			url: "<?php echo site_url('kitchen/menuitems/make_unavailable'); ?>",
			data: "id=" + menuitemid + "&available=" + 0,
			success: function(data, textStatus){
				if (data == '1'){
					$(menuitem).addClass('btn-inverse');
					$(menuitem).html("<i class='icon-plus icon-white'></i> Make Available");
					$(menuitem).attr('onclick', 'makeAvailable(event)')
				}
			}
		});
	}

	function makeAvailable(event){
		menuitem = $(event.target);
		menuitemid  = menuitem.attr('menuitemid');

		$.ajax({
			type: "POST",
			url: "<?php echo site_url('kitchen/menuitems/make_available'); ?>",
			data: "id=" + menuitemid + "&available=" + 1,
			success: function(data, textStatus){
				if (data == '1'){
					$(menuitem).removeClass('btn-inverse');
					$(menuitem).html("<i class='icon-minus'></i> Make Unavailable");
					$(menuitem).attr('onclick', 'makeUnavailable(event)')
				}
			}
		});
	}
</script>
<div id="loading" class="hide menu-loading"><img src="<?php echo base_url() . 'assets/img/loading.gif'; ?>" /></div>
<div class="menurow">
	<?php foreach ($menuitems as $menuitem): ?>
		<div class="kitchenorder">
			<div class="orderitems pull-left" style="">
				<p><b><?php echo $menuitem->name; ?></b></p>
			</div>
			<div class="orderaction pull-right">
				<?php if ($menuitem->available == 1): ?>
					<a href="#" onclick="makeUnavailable(event)" menuitemid="<?php echo $menuitem->id; ?>" data-toggle="modal" class="btn btn-large"><i class="icon-minus"></i> Make Unavailable</a>
				<?php else: ?>
					<a href="#" onclick="makeAvailable(event)" menuitemid="<?php echo $menuitem->id; ?>" data-toggle="modal" class="btn btn-large btn-inverse"><i class="icon-plus icon-white"></i> Make Available</a>
				<?php endif; ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>