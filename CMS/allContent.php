
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
			
			<div class="agile-two-grids"></div>
			
		<?php include("allNameEditingForm.php"); ?>	
			
			<script>
				window.onclick = function(event) {
				var modal = document.getElementById('editForm');
					if (event.target == modal) {
						modal.style.display = "none";
					}
				}
			</script>
			
			<noscript>Sorry, your browser does not support JavaScript!</noscript>
				
			<div class="main-grid" style="margin-top : 100px; margin-bottom : 100px;">
			<?php include("numberContentsEachCategory.php"); ?>
				
				<div class="text-center">
					<button type="button" style="width:25%;" class="btn btn-primary" id="exportButton">Export All Drama Info</button>
				</div>
				
				<div class="clearfix"> </div>
				
			<?php include("messageFadeOut.php"); ?>
				
				<h5 id='deleteStatus' style='text-align:center'></h5>
				
				<div class="agile-two-grids">
					<div class="agile-bottom-grid">
								
						<div class="area-grids-heading">
							<h3>All Content Parts <i class="fa fa-hand-o-down"></i></h3>
						</div>
						
						<div class="text-center">
							<table class="table table-responsive table-striped table-bordered table-hover text-center">
								<thead>
									<th>Part Name</th>
									<th>Part Preview</th>
									<th>Part Status</th>
									<th>Drama Name</th>
									<th>Parts Added</th>
									<th>Drama Preview</th>
									<th>Category Name</th>                                 								
									<th>Artist Name</th>
									<th>Artist Preview</th>
									<th>Actions</th>
								</thead>
							<?php
								
								$conn=oci_connect("system","Oracle_1","//localhost/orcl");
									
								$query = "SELECT DRAMACATEGORY.DRAMAID, DRAMACATEGORY.DRAMANAME, DRAMACATEGORY.CATEGORY, 
									DRAMACATEGORY.DRAMA_PREVIEW, DRAMACATEGORY.ARTIST_PREVIEW, DRAMACATEGORY.DRAMA_ROYALITY, 
									DRAMACONTENT.CID AS PARTID, DRAMACONTENT.TITLE, DRAMACONTENT.DRAMA_PREVIEW AS PARTPREVIEW, 
									DRAMACONTENT.ARTIST, DRAMACONTENT.STATUS AS PARTSTATUS, COUNT(DRAMACONTENT.CID) OVER 
									(PARTITION BY DRAMACATEGORY.DRAMAID) AS PERDRAMA FROM DRAMACATEGORY 
									INNER JOIN DRAMACONTENT ON (DRAMACATEGORY.DRAMAID=DRAMACONTENT.DRAMA_CAT_ID) 
									ORDER BY DRAMACATEGORY.CATEGORY DESC, DRAMACATEGORY.UPLOAD_DATE DESC";
								
								$parsed_Query = oci_parse($conn,$query);
								$success = oci_execute($parsed_Query);

								if($success){ 
							?>	
								<tbody>
								<?php 
									while($result_Data = oci_fetch_assoc($parsed_Query))
									{		
								?>
									<tr>
										<td> <?php echo $result_Data['TITLE'];?> </td>
										<td> <?php echo "<img src=".$result_Data['PARTPREVIEW']." height='50' width='50' alt='None'>"; ?> </td>
										<td> <?php echo $result_Data['PARTSTATUS']; ?> </td>
										<td> <?php echo $result_Data['DRAMANAME']; ?> </td>
										<td> <?php echo $result_Data['PERDRAMA']; ?> </td>
										<td> <?php echo "<img src=".$result_Data['DRAMA_PREVIEW']." height='50' width='50' alt='None'>"; ?> </td>
										<td> <?php echo $result_Data['CATEGORY']; ?> </td>
										<td> <?php echo $result_Data['ARTIST']; ?> </td>
										<?php
											if(strcmp($result_Data['CATEGORY'],'Artist')==0){
										?>
											<td> <?php echo "<img src=".$result_Data['ARTIST_PREVIEW']." height='50' width='50' alt='None'>"; ?> </td>
										
										<?php
											}
											else{
										?>
											<td> <?php echo $result_Data['ARTIST_PREVIEW']; ?> </td>
										
										<?php 
											} 
										?>
										<td> <i class="fa fa-edit" style="font-size:18px" onclick="editEvent(event,'<?php echo $result_Data['PARTID'];?>','<?php echo $result_Data['TITLE'];?>', '<?php echo $result_Data['DRAMAID'];?>', '<?php echo $result_Data['DRAMA_ROYALITY'];?>', '<?php echo $result_Data['PARTSTATUS']; ?>')"></i> <i class="fa fa-trash-o" style="font-size:18px;color:red" onclick="deleteEvent(event,'<?php echo $result_Data['PARTID'];?>')"></i> </td>
									</tr>
								<?php 
									}
									?>
								</tbody>
							<?php
								} 
								else{	
									echo 'Query didnt Execute';	
								}
								oci_close($conn);				
							?>
							</table>;
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
			
			<!-- footer -->
			<?php include("footerCms.php"); ?>
		</section>
	<script>
	//***
		$('#exportButton').click(
			function (){
				$.post("action_page.php",{exportInfo : 1},
					function(data, status){
						$('#deleteStatus').text('Exported');
						$("#deleteStatus").fadeOut(5000);
					}
				);
			}
		);
	</script>
	<noscript>Sorry, your browser does not support JavaScript!</noscript>
	</body>
</html>
