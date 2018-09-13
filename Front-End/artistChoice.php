		
	<?php
	if(in_array('Artist', $categories)){
	?>
		<div class="itemName" id="Artist"> <span class="color">Artist</span> Choice </div>
		<div class="row jumbotron">
		<?php
		$parsed_Query = artistChoice();
		?>
			<div class='content-slider'>
				<?php 
				if (isset($operator)){
					while($result_Data = oci_fetch_assoc($parsed_Query)){
				?>
					<div class="col col-sm-3 col-xs-3 text-center">
						<a href="artistChoiceDrama.php?dramaType=<?php echo base64_encode('Artist'); ?>&dramaID=<?php echo base64_encode($result_Data['DRAMA_CAT_ID']); ?>">
							<img class="img-responsive thumbnail" src="<?php echo $result_Data['ARTIST_PREVIEW']; ?>" width="182" height="268"/>
							<!--
							<div class="contentName">
								<p><?php //echo $result_Data['DRAMANAME']; ?></p>
							</div>
							-->
						</a>
					</div>
				<?php
					}
				} 
				else{
					while($result_Data = oci_fetch_assoc($parsed_Query)){
				?>
					<div class="col col-sm-3 col-xs-3 text-center">
						<a href="#operatorMsg">
							<img class="img-responsive thumbnail" src="<?php echo $result_Data['ARTIST_PREVIEW']; ?>" width="182" height="268"/>
							<!--
							<div class="contentName">
								<p><?php //echo $result_Data['DRAMANAME']; ?></p>
							</div>
							-->
						</a>
					</div>
				<?php 
					}
				} 
				?>
			</div>
		</div>
	<?php		
	}
	?>