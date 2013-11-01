<script type="text/javascript">
	$(document).ready(function(){
		randomNumber = Math.floor(Math.random() * 5);

		$('.gameselection').click(function(e){
			//hide all the prompts
			$('#sorrylose').hide(); 
			$('#congratswin').hide();
			$('#alreadyplayed').hide();

			selection = $(e.target).attr('selectionid');
			//$('#selections').slideUp('fast');

			if (selection == randomNumber){
				//you win
				//get coupon code
				$.ajax({
					type: "POST",
					url: "<?php echo site_url('customer/payment/getcoupon'); ?>",
					success: function(data, textStatus){
						if (data == 'duplicateduplicate'){
							$('#alreadyplayed').slideDown('fast');
							$('#selections').slideUp('fast');
						} else {
							$('#freecoupon').html(data);
							$('#congratswin').slideDown('fast');
						}
					}
				});
			} else {
				//you lose
				randomNumber = Math.floor(Math.random() * 5);
				$.post("<?php echo site_url('customer/payment/recordplay'); ?>", null, function(data, textstatus){
					if (data == 'duplicate'){
						$('#alreadyplayed').slideDown('fast');
						$('#selections').slideUp('fast');
					} else {
						$('#sorrylose').slideDown('fast');
					}
				});
			}
		});
	});
</script>
<div class="modal hide fade" id="game-modal" style="width:600px">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Win a Coupon!</h3>
	</div>
	<div class="modal-body">
		<p>One of these burgers would win you a free coupon. Goodluck guessing! :)</p>
		<div class="alert alert-danger hide" id="alreadyplayed">
			<strong>Sorry</strong>, you have exceeded the allowed number of attempts. Customers can play three times in a particular session.
		</div>
		<div class="alert alert-danger hide" id="sorrylose">
			<strong>Sorry</strong>, you did not make the lucky selection :(. Try again.
		</div>
		<div class="alert alert-success hide" id="congratswin">
			<strong>Congratulations! You won!</strong> Your coupon code is <strong><span id="freecoupon"></span></strong>.
		</div>
		<div class="row" id="selections">
			<div selectionid="0" class="span2 gameselection rounded-4px" style="">
				<img selectionid="0" src="<?php echo base_url() . 'assets/img/burger.png'; ?>" alt="burger" />
			</div>
			<div selectionid="1" class="span2 gameselection rounded-4px" style="">
				<img selectionid="1" src="<?php echo base_url() . 'assets/img/burger.png'; ?>" alt="burger" />
			</div>
			<div selectionid="2" class="span2 gameselection rounded-4px" style="">
				<img selectionid="2" src="<?php echo base_url() . 'assets/img/burger.png'; ?>" alt="burger" />
			</div>
			<div selectionid="3" class="span2 gameselection rounded-4px" style="">
				<img selectionid="3" src="<?php echo base_url() . 'assets/img/burger.png'; ?>" alt="burger" />
			</div>
			<div selectionid="4" class="span2 gameselection rounded-4px" style="">
				<img selectionid="4" src="<?php echo base_url() . 'assets/img/burger.png'; ?>" alt="burger" />
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<a href="#" data-dismiss="modal" class="btn btn-large">Close</a>
	</div>
</div>