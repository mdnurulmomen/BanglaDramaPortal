	<?php
	if(in_array('Serial', $categories)){
	?>
		<div class="itemName" id="Serial"> <span class="color">Serial </span>Drama</div>
		<div class="row jumbotron" style="background-color: #232935;">
		<?php
		$parsed_Query = singleDrama();	
		?>
			<div class='content-slider'>
				<?php
				if (isset($operator)){
					while($result_Data = oci_fetch_assoc($parsed_Query)){
				?>
					<div class="col col-sm-3 text-center ">		
						<a href="vedioDrama.php?dramaType=<?php echo base64_encode('Serial'); ?>&dramaID=<?php echo base64_encode($result_Data['DRAMA_CAT_ID']); ?>">
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
				}else{
					while($result_Data = oci_fetch_assoc($parsed_Query)){
				?>
					<div class="col col-sm-3 text-center ">	
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
			if (isset($operator)){?>
				<li class="next"><a href="more.php?dramaType=<?php echo base64_encode('Serial'); ?>">more <i class="fa fa-angle-double-right"></i> </a></li>
			<?php
			}else{
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