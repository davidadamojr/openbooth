<div class="modal hide fade" id="payment-modal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Make Payment</h3>
	</div>
	<div class="modal-body">
		<h4>Payment for Order #<span id="orderid">1234</span></h4>
		<form id="paymentform" method="post" action="<?php echo site_url('waiter/orders/makepayment'); ?>">
			<table class="form" style="width:70%">
				<tbody>
					<tr>
						<td class="formlabel">Cash Amount</td>
						<td>$ <input name="amount" type="text" class="span1 validate[required]" value="" /><!--&nbsp;&nbsp; <a href="#" class="btn">Comp</a>--></td>
					</tr>
					<tr>
						<td class="formlabel">Tax Amount</td>
						<td>$ <input name="tax" type="text" class="span1 validate[required]" value="" /><!--&nbsp;&nbsp; <a href="#" class="btn">Comp</a>--></td>
					</tr>
					<tr>
						<td class="formlabel">Tip</td>
						<td>$ <input name="tip" type="text" class="span1" value="0" /><!--&nbsp;&nbsp; <a href="#" class="btn">Comp</a>--></td>
					</tr>
					<input name="orderid" type="hidden" />
				</tbody>
			</table>
		</form>
	</div>
	<div class="modal-footer" style="text-align:left;">
		<a href="#" onclick="$('#paymentform').submit()" class="btn btn-large"><i class="icon-ok"></i> Make Payment</a>
		&nbsp;&nbsp;
		<a href="#" data-dismiss="modal" class="btn btn-large"><i class="icon-remove"></i> Cancel</a>
	</div>
</div>