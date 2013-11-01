<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to McDowel's</title>
		<?php echo $dependencies; ?>
	</head>

	<body>
		<?php echo $header; ?>
		<div class="container-fluid" style="margin-top:120px;">
			<div class="row-fluid">
				<div class="span12 outer-frame rounded-6px">
					<div class="whitebg">
						<div class="boxheading toprounded-4px">
							Tables
						</div>
						<div class="singlecontent padding-10px">
							<?php foreach ($tables as $table): ?>
								<div class="kitchenorder <?php if ($table->isOccupied()) echo 'pending'; ?>">
									<div class="" style="">
										<div class="tablenumber rounded-4px pull-left">
											<?php echo $table->tablenumber; ?>
										</div>
										<p><b>Status:</b> <?php if ($table->isOccupied()) echo "Occupied"; else echo "Empty"; ?></p>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php echo $comporder; ?>
	</body>
</html>