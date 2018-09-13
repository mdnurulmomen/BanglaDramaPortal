	
	<?php
	if(in_array('Featured', $categories)){
	?>
		<div id="Featured"></div>
				
		<div class="row jumbotron">
			<div class="container-fluid">
				<div class="row">
					<div class="col col-sm-4 col-xs-4 text-center">
					  <button class="btn btn-default btn-md tablinks " onclick="openTab(event, 'Featured')">Featured</button>
					</div>
					
					<div class="col col-sm-4 col-xs-4 text-center">
					  <button class="btn btn-default btn-md tablinks" onclick="openTab(event, 'Recent')">Recent</button>
					</div>
					
					<div class="col col-sm-4  col-xs-4 text-center">
					  <button class="btn btn-default btn-md tablinks" onclick="openTab(event, 'TopViewed')">Top Viewed</button>
					</div>
				</div>
				
				<div class="row jumbotron" style="background-color: inherit;">	
					<?php
					$parsed_Query = featuredDrama();		
					?>
					<div class="content-slider">
					<?php
					while($result_Data = oci_fetch_assoc($parsed_Query)){
					?>
						<div class="col col-sm-3 col-xs-3 text-center tabcontent Featured">	
						<?php
						if (isset($operator)){
						?>
							<a href="vedioDrama.php?dramaType=<?php echo base64_encode('Featured'); ?>&dramaID=<?php echo base64_encode($result_Data['DRAMA_CAT_ID']); ?>">
								<img class="img-responsive thumbnail" src="<?php echo $result_Data['DRAMA_PREVIEW']; ?>" width="250" height="300"/>
								<!--
								<div class="contentName">
									<p><?php //echo $result_Data['DRAMANAME']; ?></p>
								</div>
								-->
							</a>
						<?php
						}else{ 
						?>
							<a href="#operatorMsg">
								<img class="img-responsive thumbnail" src="<?php echo $result_Data['DRAMA_PREVIEW']; ?>" width="250" height="300"/>
								<!--
								<div class="contentName">
									<p><?php //echo $result_Data['DRAMANAME']; ?></p>
								</div>
								-->
							</a>
						<?php
						}
						?>
					
						</div>
					<?php		
					}
					?>
						
					<?php
					$parsed_Query = recentDrama();	
					
					while($result_Data = oci_fetch_assoc($parsed_Query)){
					?>
						<div class="col col-sm-3 col-xs-3 text-center tabcontent Recent">
						<?php 	
						if (isset($operator)){
						?>
							<a href="recentDrama.php?dramaType=<?php echo base64_encode('Recent'); ?>&dramaID=<?php echo base64_encode($result_Data['DRAMA_CAT_ID']); ?>&dramaPartID=<?php echo base64_encode($result_Data['CID']); ?>">
								<img class="img-responsive thumbnail" src="<?php echo $result_Data['DRAMA_PREVIEW']; ?>" width="250" height="300"/>
								<!--
								<div class="contentName">
									<p><?php //echo $result_Data['DRAMANAME']; ?></p>
								</div>
								-->
							</a>
						<?php
						}else{
						?>
							<a href="#operatorMsg">
								<img class="img-responsive thumbnail" src="<?php echo $result_Data['DRAMA_PREVIEW']; ?>" width="250" height="300"/>
								<!--
								<div class="contentName">
									<p><?php //echo $result_Data['DRAMANAME']; ?></p>
								</div>
								-->
							</a>
						<?php
						}
						?>
					
						</div>
					<?php		
					}
					?>
						
					<?php
					$parsed_Query = mostViewedDrama();
					
					while($result_Data = oci_fetch_assoc($parsed_Query)){
					?>
						<div class="col col-sm-3 col-xs-3 text-center tabcontent TopViewed">
							
						<?php
						if (isset($operator)){
						?>
							<a href="mostViewedDrama.php?dramaType=<?php echo base64_encode('MostViewed'); ?>&dramaPartID=<?php echo base64_encode($result_Data['CID']); ?>">
								<img class="img-responsive thumbnail" src="<?php echo $result_Data['DRAMA_PREVIEW']; ?>" width="250" height="300"/>
								<!--
								<div class="contentName">
									<p><?php //echo $result_Data['DRAMANAME']; ?></p>
								</div>
								-->
							</a>
						<?php
						}else{
						?>
							<a href="#operatorMsg">
								<img class="img-responsive thumbnail" src="<?php echo $result_Data['DRAMA_PREVIEW']; ?>" width="250" height="300"/>
								<!--
								<div class="contentName">
									<p><?php //echo $result_Data['DRAMANAME']; ?></p>
								</div>
								-->
							</a>
						<?php
						}
						?>
					
						</div>
					<?php		
					}
					?>
					</div>
				</div>
			</div>
		</div>
			
	<?php		
	}
	else{
		//echo 'No Featured';
	}
	?>