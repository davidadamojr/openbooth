<div class="modal hide fade" id="receipt-modal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Receipt</h3>
	</div>
	<div id="moreinfo" class="modal-body">
		<table class="form">
			<?php foreach ($receiptitems as $item): ?>
				<tr>
					<td class="formlabel"><?php echo $item->name; ?></td>
					<td><?php echo $item->price; ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td class="formlabel">Tax</td>
				<td><?php echo $amounts->tax; ?></td>
			</tr>
			<tr>
				<td class="formlabel">Total</td>
				<td><?php echo $amounts->amount; ?></td>
			</tr>
		</table>
	</div>
	<div class="modal-footer">
		<a href="#" data-dismiss="modal" class="btn btn-large">Close</a>
	</div>
</div>