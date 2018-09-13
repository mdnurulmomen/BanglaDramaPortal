<!DOCTYPE html>
<html lang="en">
	
	<?php include("mobileOperator.php"); ?>
	<?php include("reference.php"); ?>
	
	<body>
		<div class="container">
		<?php include("header.php"); ?>	
		<?php include("drawer.php"); ?>
		
			<h4>Please Confirm ..</h4>
			<div class="row text-center">
				<h5 class='text-warning'><strong>Service Name :</strong></h5>
				<p>Bangla Drama Portal</p>
				<h5 class='text-info'>Charge :</h5>
				<p>BDT 2.44 tk per day with Auto Renewal.</p>
				<a href="finalConfirmation.php" class="btn btn-default btn-block" style="width: 100%;" role="button" aria-pressed="true">Proceed</a>
				<p>or</p>
				<a href="index.php" class="btn btn-default btn-block" style="width: 100%;" role="button" aria-pressed="true">Cancel</a>
			</div>
		<?php include("bottomMenu.php"); ?>
		</div>	
		<script src="./CustomLibraries/myScripts.js"></script>
	</body>
</html>
