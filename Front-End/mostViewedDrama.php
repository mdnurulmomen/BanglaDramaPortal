<!DOCTYPE html>
<html lang="en">

	<?php
	include("mobileOperator.php");
	
	if(!isset($operator))
		header('Location: index.php');
	?>

	<?php include("reference.php"); ?>
	
	<body>
		<div class="container-fluid">
		
		<?php
		include("header.php");
		include("drawer.php");
		include("function.php"); 
		?>
		
		<?php
		$selectedDramaType = base64_decode($_REQUEST['dramaType']);
		$selectedDramaPartID = base64_decode($_REQUEST['dramaPartID']);
		
		$parsed_Query = mostViewedDramaAllParts();
		
		if($parsed_Query){
			$nrows = oci_fetch_all($parsed_Query, $result);
			oci_free_statement($parsed_Query);
			if ($nrows > 0){
				list($listVariable) = array($result);
				$dramaPartId=$listVariable['CID'];
				$dramaName=$listVariable['DRAMANAME'];
				$dramaPartPreview=$listVariable['DRAMA_PREVIEW'];
				$dramaPartFilePath=$listVariable['DRAMA_FILEPATH'];
				
				for($index=0; $index<sizeof($dramaPartId); $index++){
					if($dramaPartId[$index]== $selectedDramaPartID){
						$swapingIndex = $index;
						break;
					}
				}
					
				list($tempPartId, $tempPartName, $tempPartPreview, $tempPartFilePath) = array($dramaPartId[0], $dramaName[0], $dramaPartPreview[0], $dramaPartFilePath[0]);
				list($dramaPartId[0], $dramaName[0], $dramaPartPreview[0], $dramaPartFilePath[0]) = array($dramaPartId[$swapingIndex], $dramaName[$swapingIndex], $dramaPartPreview[$swapingIndex], $dramaPartFilePath[$swapingIndex]);
				list($dramaPartId[$swapingIndex], $dramaName[$swapingIndex], $dramaPartPreview[$swapingIndex], $dramaPartFilePath[$swapingIndex]) = array($tempPartId, $tempPartName, $tempPartPreview, $tempPartFilePath);
			}
			else{
				$dramaPartId = array();
			}
		}
		?>
			
			<div class="row">
				<video width="100%" controls poster="<?php echo $dramaPartPreview[0]; ?>">
				  <source src="<?php echo $dramaPartFilePath[0]; ?>" type="video/mp4">
				  <source src="<?php echo $dramaPartFilePath[0]; ?>" type="video/ogg">
				  Your browser does not support the video tag.
				</video> 
			</div>
			
		<?php include("countViews.php"); ?>
		
		<?php 
		if(sizeof($dramaPartId)>5){
		?> 	
			<div class="itemName"> Other <span class="color"><?php echo $selectedDramaType; ?> </span> Drama</div>
			<div class="row jumbotron">
				<div class="content-slider">
				<?php
					for($i=1; $i<count($dramaPartId); $i++){
				?>
					<div class="col col-sm-3 col-xs-3 text-center">
						<a href="mostViewedDrama.php?dramaType=<?php echo base64_encode('MostViewed'); ?>&dramaPartID=<?php echo base64_encode($dramaPartId[$i]); ?>">
						  <img class="img-responsive rounded" src="<?php echo $dramaPartPreview[$i]; ?>" width="250" height="300"/>
						  <div class="contentName">
							<p><?php echo $dramaName[$i]; ?><a href="<?php echo $dramaPartFilePath[$i]; ?>" download="<?php echo $dramaName[$i]; ?>">| Download </a></p>
						  </div>
						</a>
					</div>
				<?php
					}
				?>
				</div>
			</div>
		<?php
		}else if(sizeof($dramaPartId)>1 && sizeof($dramaPartId)<6){
		?>
			<div class="itemName"> Other <span class="color"><?php echo $selectedDramaType; ?> </span> Drama</div>
			<div class="row jumbotron">
				<?php
				for($i=1; $i<count($dramaPartId); $i++){
				?>
					<div class="col col-sm-3 col-xs-3 text-center" style="padding:3px;">
						<a href="mostViewedDrama.php?dramaType=<?php echo base64_encode('MostViewed'); ?>&dramaPartID=<?php echo base64_encode($dramaPartId[$i]); ?>">
						  <img class="img-responsive rounded" src="<?php echo $dramaPartPreview[$i]; ?>" width="250" height="300"/>
						  <div class="contentName">
							<p><?php echo $dramaName[$i]; ?> <a href="<?php echo $dramaPartFilePath[$i]; ?>" download="<?php echo $dramaName[$i]; ?>">| Download </a></p>
						  </div>
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
		include("artistChoice.php");
		include("bottomMenu.php");
		include("footer.php"); 
		?>						
			
		</div>
		
		<script src="./CustomLibraries/myScripts.js"></script> 

	</body>
</html>
