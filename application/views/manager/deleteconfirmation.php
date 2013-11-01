<div class="modal hide fade" id="confirm-modal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Are you sure?</h3>
	</div>
	<div class="modal-body">
		<p>Are you sure you want to delete this entry?</p>
	</div>
	<div class="modal-footer">
		<a href="<?php echo site_url('manager/useraccounts/delete/'); ?>" id="btnDelete" class="btn btn-large transition">Yes</a>
		&nbsp;&nbsp;
		<a href="#" data-dismiss="modal" class="btn btn-large">No</a>
	</div>
</div>