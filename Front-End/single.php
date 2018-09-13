	<?php
	if(in_array('Single', $categories)){
	?>
		<div class="itemName" id="Single"> <span class="color">Single </span>Drama</div>
		<div class="row jumbotron" style="background-color: #990000;">
		<?php
		$parsed_Query = singleDrama();
		?>
			<div class='content-slider'>
				<?php 
				if (isset($operator)){
					while($result_Data = oci_fetch_assoc($parsed_Query)){
				?>
					<div class="col col-sm-3 col-xs-3 text-center">
						<a href="vedioDrama.php?dramaType=<?php echo base64_encode('Single'); ?>&dramaID=<?php echo base64_encode($result_Data['DRAMA_CAT_ID']); ?>">
							<img class="img-responsive thumbnail" src="<?php echo $result_Data['DRAMA_PREVIEW']; ?>" width="250" height="300"/>
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
							<img class="img-responsive thumbnail" src="<?php echo $result_Data['DRAMA_PREVIEW']; ?>" width="250" height="300"/>
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
			
			<ul class="pager more">
			<?php 
			if (isset($operator)){
			?>
				<li class="next"><a href="more.php?dramaType=<?php echo base64_encode('Single'); ?>">more <i class="fa fa-angle-double-right"></i> </a></li>
			<?php 
			} 
			else{ 
			?>
				<li class="next"><a href="javascript:void(0)">more <i class="fa fa-angle-double-right"></i> </a></li>
			<?php	
			} 
			?>
			</ul>
		</div>
	<?php		
	}
	?>