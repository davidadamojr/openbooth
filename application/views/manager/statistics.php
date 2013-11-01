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
				<?php echo $sidebar; ?>
				<div class="span9 outer-frame rounded-6px" style="">
					<div class="whitebg" style="height:400px; overflow: auto">
                                                    <!-- Tab Content-->
                                                    <div class="tab-content" >
                                                        <div class="tab-pane fade in active " id="cpd"> <?php echo $cpd;?></div>
                                                        <div class="tab-pane fade" id="icpw"> <?php echo $icpw;?> </div>
                                                        <div class="tab-pane fade" id="gr"> <?php echo $gr;?> </div>
                                                        <div class="tab-pane fade" id="fh"><?php echo $fh; ?></div>

                                                    </div>

					</div>
				</div>
			</div>
		</div>
	</body>
</html>