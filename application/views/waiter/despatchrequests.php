<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to McDowel's</title>
		<?php echo $dependencies; ?>
		<script type="text/javascript">
			function acceptRequest(event){
				request = $(event.target);
				requestid = request.attr('requestid');

				if (!request.hasClass('disabled')){
					$.ajax({
						type: "POST",
						url: "<?php echo site_url('waiter/despatchrequests/accept'); ?>",
						data: "id=" + requestid,
						success: function(data, textStatus){
							request.addClass('disabled');
							request.html("Accepted");
							request.parent().parent().removeClass('pending');
						}
					});
				}
			}

			function resolveRequest(event){
				request = $(event.target);
				requestid = request.attr('requestid');

				if (!request.hasClass('disabled')){
					$.ajax({
						type: "POST",
						url: "<?php echo site_url('waiter/despatchrequests/resolve'); ?>",
						data: "id=" + requestid,
						success: function(data, textStatus){
							request.addClass('disabled');
							request.html("Delivered");
							request.parent().parent().removeClass('pending');
						}
					});
				}
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
							Despatch Requests
						</div>
						<div class="singlecontent padding-10px">
							<div class="tabbable">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#pending" data-toggle="tab">Pending</a></li>
									<li><a href="#accepted" data-toggle="tab">Accepted</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-content">
										<div class="tab-pane active" id="pending">
											<?php if (empty($unaccepted_despatch)): ?>
												<div class="alert alert-danger">
													There are no pending despatch notifications at this time.
												</div>
											<?php endif; ?>
											<?php foreach ($unaccepted_despatch as $unaccepted): ?>
												<div class="kitchenorder pending">
													<div class="ordereditems pull-left" style="">
														<div class="tablenumber rounded-4px pull-left">
															<?php echo $unaccepted->tablenumber; ?>
														</div>
														<p>
															Order for <b><?php echo $unaccepted->customername; ?></b> at <b>Table <?php echo $unaccepted->tablenumber; ?></b> is ready to be delivered.<br/>
															<b>Ordered Items:</b> 
															<?php
																$ordereditems = $unaccepted->getOrderedItems();
																$count = 0;
																foreach ($ordereditems as $ordereditem){
																	if ($count != 0 && $count != count($ordereditems))
																		echo ', ';
																	echo $ordereditem->itemname;
																	$count = $count + 1;
																}
															?>
														</p>
													</div>
													<div class="orderaction pull-right">
														<a href="#" requestid="<?php echo $unaccepted->id; ?>" onclick="acceptRequest(event)" class="btn btn-large"><i class="icon-eye-open"></i> Accept</a>
													</div>
												</div>
											<?php endforeach; ?>
										</div>
										<div class="tab-pane" id="accepted">
											<?php if (empty($accepted_despatch)): ?>
												<div class="alert alert-danger">
													There are no unresolved despatch notifications at this time.
												</div>
											<?php endif; ?>
											<?php foreach ($accepted_despatch as $accepted): ?>
												<div class="kitchenorder pending">
													<div class="ordereditems pull-left" style="">
														<div class="tablenumber rounded-4px pull-left">
															<?php echo $accepted->tablenumber; ?>
														</div>
														<p>
															Order for <b><?php echo $accepted->customername; ?></b> at <b>Table <?php echo $accepted->tablenumber; ?></b> is ready to be delivered.<br/>
															<b>Ordered Items:</b>
															<?php
																$ordereditems = $accepted->getOrderedItems();
																$count = 0;
																foreach ($ordereditems as $ordereditem){
																	if ($count != 0 && $count != count($ordereditems))
																		echo ', ';
																	echo $ordereditem->itemname;
																	$count = $count + 1;
																}
															?>
														</p>
													</div>
													<div class="orderaction pull-right">
														<a href="#" requestid="<?php echo $accepted->id; ?>" onclick="resolveRequest(event)" class="btn btn-large"><i class="icon-ok"></i> Resolve</a>
													</div>
												</div>
											<?php endforeach; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br />
	</body>
</html>