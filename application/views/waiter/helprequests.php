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
						url: "<?php echo site_url('waiter/helprequests/accept'); ?>",
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
						url: "<?php echo site_url('waiter/helprequests/resolve'); ?>",
						data: "id=" + requestid,
						success: function(data, textStatus){
							request.addClass('disabled');
							request.html("Resolved");
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
							Help Requests
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
											<?php if (empty($unacceptedrequests)): ?>
												<div class="alert alert-danger">
													There are no pending help requests at this time.
												</div>
											<?php endif; ?>
											<?php foreach ($unacceptedrequests as $unaccepted): ?>
												<div class="kitchenorder pending">
													<div class="ordereditems pull-left" style="">
														<div class="tablenumber rounded-4px pull-left">
															<?php echo $unaccepted->tablenumber; ?>
														</div>
														<p><b>Table <?php echo $unaccepted->tablenumber; ?></b> needs attention.</p>
													</div>
													<div class="orderaction pull-right">
														<a href="#" onclick="acceptRequest(event)" requestid="<?php echo $unaccepted->id; ?>" class="btn btn-large"><i class="icon-eye-open"></i> Accept</a>
													</div>
												</div>
											<?php endforeach; ?>
										</div>
										<div class="tab-pane" id="accepted">
											<?php if (empty($acceptedrequests)): ?>
												<div class="alert alert-danger">
													There are no unresolved requests at this time.
												</div>
											<?php endif; ?>
											<?php foreach ($acceptedrequests as $accepted): ?>
												<div class="kitchenorder pending">
													<div class="ordereditems pull-left" style="">
														<div class="tablenumber rounded-4px pull-left">
															<?php echo $accepted->tablenumber; ?>
														</div>
														<p><b>Table <?php echo $accepted->tablenumber; ?></b> needs attention.</p>
													</div>
													<div class="orderaction pull-right">
														<a href="#" requestid="<?php echo $accepted->id; ?>" onclick="resolveRequest(event)" class="btn btn-large"><i class="icon-ok"></i> Resolved</a>
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