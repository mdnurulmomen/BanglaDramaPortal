		
	<?php	
	if(isset($operator)){
		if(strcmp($operator, 'Robi')!=0){
	?>
			<div class="row text-center">
				<a href="autoRenewalConfirmation.php" class="btn btn-success" role="button" aria-pressed="true">Subscribe</a>
				
				<pre>	
		 Unlimited Drama Streaming and Five Free Downloads/Day. Subscription 
		 Charge BDT 2.44/Day. To Unsubscribe, type STOP DP and send to 16427
				</pre>	
					
			</div>

		<?php
		}
		else{
		?>	
			<div class="row text-center">
			
				<a href="autoRenewalConfirmation.php" class="btn btn-success" role="button" aria-pressed="true">Subscribe with Auto Renewal</a>
				<a href="packages.php" class="btn btn-success" style="margin-top:15px;" role="button" aria-pressed="true">Subscribe with Non Auto Renewal</a>
				
				<pre>	
		 Unlimited Drama Streaming and Five Free Downloads/Day. Subscription 
		 Charge BDT 2.44/Day. To Unsubscribe, type STOP DP and send to 16427
				</pre>	
					
			</div>			
	<?php		
		}
	}
	else{
		echo "<p class='color' style='text-align : center'>Please Try with Robi, Banglalink, GrameenPhone.";
	}
	?>


	
