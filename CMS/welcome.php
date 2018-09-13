<?php 
	session_start();
	if(!isset($_SESSION['login_user'])){
		$Message = "Please Login First";
		session_unset();
		session_destroy();
		header("Location:index.php?Message={$Message}");
	}
?>

<!DOCTYPE html>
	
	<?php include("referencesCms.php"); ?>
	
	<body class="dashboard-page">
	
	<?php include("dashBoard.php"); ?>	
		
		<section class="wrapper scrollable">
		
		<?php include("banglaDramaCmsHeader.php"); ?>	
		<?php include("dramaPartNameEditForm.php");?>
		
			<div class="main-grid" style="margin-top : 100px; margin-bottom : 100px;">
			<?php include("messageFadeOut.php"); ?>	
				<div class="agile-grids">
					<div class="agile-bottom-grid">
						<?php include("recentUploads.php"); ?>
					</div>
					
					<div class="clearfix"> </div>
				</div>
			</div>
			
			<!-- footer -->
			<?php include("footerCms.php"); ?>	
		</section>
	</body>
</html>
