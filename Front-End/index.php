<!DOCTYPE html>
<html lang="en">
	
	<?php include("reference.php"); ?>
	
	<body>
		<div class="container-fluid">
			
			<?php 
			include("header.php");
			include("drawer.php");  
			include("mobileOperator.php");
			include("function.php");
			?>
			
			<div class="row jumbotron">
			
				<?php 
				$parsed_Query = headingPreviews();
				?>
				
				<div class="content-slider">		
					<?php
					if (!isset($operator)){
						while($result_Data = oci_fetch_assoc($parsed_Query)){
					?>
						<div class="col col-sm-3 col-xs-3 text-center">
							<a href="#operatorMsg">
								<img class="img-responsive rounded" src="<?php echo $result_Data['DRAMA_PREVIEW']; ?>" width="250" height="300"/>
							</a>
						</div>
					<?php
						}
					}else{
						while($result_Data = oci_fetch_assoc($parsed_Query)){
					?>
						<div class="col col-sm-3 col-xs-3 text-center">
							<a href="vedioDrama.php?dramaType=<?php echo base64_encode($result_Data['CATEGORY']); ?>&dramaID=<?php echo base64_encode($result_Data['DRAMAID']); ?>">
								<img class="img-responsive rounded" src="<?php echo $result_Data['DRAMA_PREVIEW']; ?>" width="250" height="300"/>
							</a>
						</div>
					<?php
						}
					}
					?>
					<span id='operatorMsg'></span> 
				</div>
			</div>
			
			<?php include("subscribe.php"); ?>
			
			<div class="row jumbotron text-center" style="background-color:#000;">
				<div  class='col-sm-4 col-xs-4  text-center'>
					<i class="fa fa-desktop" onclick="goCategory(event, 'Single')"></i><br/>
					<span  class='caption text-center'>Single Drama</span>
				</div>
				<div class='col-sm-4 col-xs-4  text-center'>
					<i class="fa fa-caret-square-o-right" onclick="goCategory(event, 'Serial')"></i><br/>
					<span class='caption text-center'>Serial Drama</span>
				</div>
				<div class='col-sm-4 col-xs-4  text-center'>
					<i class="fa fa-film" onclick="goCategory(event, 'Artist')"></i><br/>
					<span class='caption text-center'>Artist Choice</span>
				</div>   
			</div>
			
			<?php 
			include("categoryCheck.php");  
			include("single.php"); 
			include("serial.php"); 
			include("artistChoice.php");  
			include("featured.php");
			include("bottomMenu.php");
			include("footer.php");
			?>					
		</div>
				
		<script src="./CustomLibraries/myScripts.js"></script>

	</body>
</html>
