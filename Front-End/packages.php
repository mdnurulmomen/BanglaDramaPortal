<!DOCTYPE html>
<html lang="en">
	
	<?php include("mobileOperator.php"); ?>
	<?php include("reference.php"); ?>
	
	<body>
		<div class="container">
		<?php include("header.php"); ?>	
		<?php include("drawer.php"); ?>
		
			<div class="row text-center">
				<a href="finalConfirmation.php" class="btn btn-default btn-block" style="width: 100%;" role="button" aria-pressed="true">Daily Pack</a>
				<a href="finalConfirmation.php" class="btn btn-default btn-block" style="width: 100%;" role="button" aria-pressed="true">Weekly Pack</a>
				<a href="finalConfirmation.php" class="btn btn-default btn-block" style="width: 100%;" role="button" aria-pressed="true">Fortnightly Pack</a>
				<a href="finalConfirmation.php" class="btn btn-default btn-block" style="width: 100%;" role="button" aria-pressed="true">Monthly Pack</a>
			</div>
			
			<div class="row text-center">
				<a href="index.php" class="btn btn-danger">Cancel</a>
			</div>
			<?php include("bottomMenu.php"); ?>
		</div>	
		<script src="./CustomLibraries/myScripts.js"></script>
	</body>
</html>
