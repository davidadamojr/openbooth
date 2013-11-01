<script type="text/javascript">
	function setForDelivery(event)
	{
		order_id = $('#btnDelivery').attr('orderid');
		$.post("<?php echo site_url('kitchen/orders/completeorder'); ?>", "id="+ order_id + "&status=2");
	}
</script>
<div class="modal hide fade" id="vieworder-modal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Order Details for <span id="tablenumber">Table 2</span>, <span id="tabletnumber">Device 2</span> (<span id="customername">David</span>)</h3>
	</div>
	<div id="loading"><img src="<?php echo base_url() . 'assets/img/loading.gif'; ?>" /></div>
	<div id="orderdetails" class="modal-body hide">
		
	</div>
	<div class="modal-footer">
		<a orderid="" id="btnDelivery" onclick="setForDelivery(event)"  href="#" data-dismiss="modal" class="btn btn-large"><i class="icon-ok"></i> Ready for Delivery</a>
		&nbsp;&nbsp;&nbsp;
		<a href="#" data-dismiss="modal" class="btn btn-large"><i class="icon-remove"></i> Close</a>
	</div>
</div>