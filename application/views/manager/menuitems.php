<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to McDowel's</title>
		<?php echo $dependencies; ?>
		<script type="text/javascript">
			function deleteItem(event){
				item = $(event.target);
				itemid = item.attr('itemid');

				$('#btnDelete').attr('href', "<?php echo site_url('manager/menuitems/delete'); ?>" + '/' + itemid);
			}
		</script>
	</head>

	<body>
		<?php echo $header; ?>
		<div class="container-fluid" style="margin-top:120px;">
			<div class="row-fluid">
				<div class="span12 outer-frame rounded-6px">
					<div class="whitebg">
						<div class="boxheading toprounded-4px" style="padding-bottom:15px;">
							Menu Items
							<a href="<?php echo site_url('manager/menuitems/add'); ?>" class="btn pull-right transition" style="margin-right:14px;">Add Menu Item</a>
						</div>
						<div class="singlecontent padding-10px">
							<?php if ($this->session->flashdata('successmsg') != ''): ?>
								<div class="alert alert-success" >
									<button type="button" class="close" data-dismiss="alert">x</button>
									<h4><?php echo $this->session->flashdata('successmsg'); ?></h4>
								</div>
							<?php endif; ?>

							<?php if ($this->session->flashdata('fileuploaderror') != ''): ?>
								<div class="alert alert-success" >
									<button type="button" class="close" data-dismiss="alert">x</button>
									<h4><?php echo $this->session->flashdata('fileuploaderror'); ?></h4>
								</div>
							<?php endif; ?>


							<?php if (empty($menuitems)): ?>
								<div class="alert alert-danger">
									There are no menu items to display.
								</div>
							<?php endif; ?>

							<?php foreach ($menuitems as $menuitem): ?>
								<div class="kitchenorder">
									<div class="orderitems pull-left" style="">
										<p class="">
											<b><?php echo $menuitem->name; ?></b>
										</p>
									</div>
									<div class="orderaction pull-right">
										<a href="<?php echo site_url('manager/menuitems/edit/' . $menuitem->id); ?>" class="btn btn-large">Edit</a>
										&nbsp;&nbsp;
										<a href="#confirm-modal" itemid="<?php echo $menuitem->id; ?>" onclick="deleteItem(event)" data-toggle="modal" class="btn btn-large">Delete</a>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php echo $deleteconfirm; ?>
	</body>
</html>