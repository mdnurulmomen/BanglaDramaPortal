<!DOCTYPE html>
<html lang="en">

	<?php 
	include("mobileOperator.php");

	if(!isset($operator))
		header('Location: index.php');
	?>
	<body>
		<div class="container-fluid">
			
		<?php	
		include("reference.php"); 
		include("header.php"); 
		include("drawer.php"); 
	
		$selectedDramaType = base64_decode($_REQUEST['dramaType']);
		
		include("function.php");
		
		$parsed_Query = more($selectedDramaType);
		
		if($parsed_Query){
			$nrows = oci_fetch_all($parsed_Query, $result);
			oci_free_statement($parsed_Query);
			
			if ($nrows > 0){
				list($listVariable) = array($result);
				// $allDramaName=$listVariable['DRAMANAME'];
				$allDramaId=$listVariable['DRAMA_CAT_ID'];
				$allDramaPreview=$listVariable['DRAMA_PREVIEW'];
			}
			else{
				$allDramaId = array();
			}
		}
		else{
			// echo 'NOT';
			// echo "<script type='text/javascript'>alert('ShaKeR');</script>";
		}
		?>
		<?php
		if(sizeof($allDramaId)>=10){
		?>
			<div class="itemName"> All <span class="color"><?php echo $selectedDramaType; ?> </span>Drama</div>
			<div class="row jumbotron">
			
			<?php	
			$halfCount = ceil(.5*(count($allDramaId)));	
			?>	
				
				<div class='content-slider'>
				<?php
				for($i = 0; $i<$halfCount; $i++){ 
				?>	
					<div class="col col-sm-3 col-xs-3 text-center">						
						<a href="vedioDrama.php?dramaType=<?php echo base64_encode($selectedDramaType);?>&dramaID=<?php echo base64_encode($allDramaId[$i]);?>">
						  <img class="img-responsive thumbnail" src="<?php echo $allDramaPreview[$i]; ?>" width="250" height="300"/>
						  <!--
						  <div class="contentName">
							<p><?php //echo $allDramaName[$i]; ?></p>
						  </div>
						  -->
						</a>	
					</div>
				<?php 
				} 
				?>
				</div>
			</div>
			
			<div class="row jumbotron">
				<div class='content-slider'>
				<?php
				for($i = $halfCount; $i<count($allDramaId); $i++){ 
				?>	
					<div class="col col-sm-3 col-xs-3 text-center">						
						<a href="vedioDrama.php?dramaType=<?php echo base64_encode($selectedDramaType);?>&dramaID=<?php echo base64_encode($allDramaId[$i]);?>">
						  <img class="img-responsive thumbnail" src="<?php echo $allDramaPreview[$i]; ?>" width="250" height="300"/>
						  <!--
						  <div class="contentName">
							<p><?php //echo $allDramaName[$i]; ?></p>
						  </div>
						  -->
						</a>	
					</div>
				<?php 
				} 
				?>
				</div>
			</div>
		<?php 
		}else if(sizeof($allDramaId)>0 && sizeof($allDramaId)<10){
		?>
			<div class="itemName"> All <span class="color"><?php echo $selectedDramaType; ?> </span>Drama</div>
			<div class="row jumbotron">
			<?php	
			$halfCount = round(.5*(count($allDramaId)));	
			
			for($i = 0; $i<$halfCount; $i++){ 
			?>	
				<div class="col col-sm-3 col-xs-3 text-center" style="padding:3px;">						
					<a href="vedioDrama.php?dramaType=<?php echo base64_encode($selectedDramaType);?>&dramaID=<?php echo base64_encode($allDramaId[$i]);?>">
					  <img class="img-responsive thumbnail" src="<?php echo $allDramaPreview[$i]; ?>" width="250" height="300"/>
					  <!--
					  <div class="contentName">
						<p><?php //echo $allDramaName[$i]; ?></p>
					  </div>
					  -->
					</a>	
				</div>
			<?php 
			} 
			?>
			</div>
			
			<div class="row jumbotron">
			<?php
			for($i = $halfCount; $i<count($allDramaId); $i++){ 
			?>	
				<div class="col col-sm-3 col-xs-3 text-center" style="padding:3px;">						
					<a href="vedioDrama.php?dramaType=<?php echo base64_encode($selectedDramaType);?>&dramaID=<?php echo base64_encode($allDramaId[$i]);?>">
					  <img class="img-responsive thumbnail" src="<?php echo $allDramaPreview[$i]; ?>" width="250" height="300"/>
					  <!--
					  <div class="contentName">
						<p><?php //echo $allDramaName[$i]; ?></p>
					  </div>
					  -->
					</a>	
				</div>
			<?php 
			} 
			?>
			</div>
		<?php
		}
		?>
		
		<?php
		include("categoryCheck.php");
		include("featured.php");
		include("bottomMenu.php");
		include("footer.php");
		?>					
			
		</div>
				
		<script src="./CustomLibraries/myScripts.js"></script> 
		
	</body>
</html>
