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
		<?php include("allNameEditingForm.php"); ?>
				
			<script>
				// Get the modal
				var modal = document.getElementById('editForm');

				// When the user clicks anywhere outside of the modal, close it
				window.onclick = function(event) {
					if (event.target == modal) {
						modal.style.display = "none";
					}
				}
			</script>
			
			<div class="main-grid" style="margin-top : 100px; margin-bottom : 100px;">
				
				<div class="agile-grids">
					<div class="agile-bottom-grid">
						<?php include("buttonsDistinctPartsOnly.php"); ?>
					</div>
				</div>
					
			<?php include("messageFadeOut.php"); ?>	
				
				<h5 id='deleteStatus' style='text-align:center'></h5>
				
				<div class="agile-two-grids">
					<div class="agile-bottom-grid">
						<div class="area-grids-heading">
							<h3>All Published Parts <i class="fa fa-hand-o-down"></i></h3>
						</div>

						<div class="text-center">
							<table class="table table-responsive table-striped table-bordered table-hover text-center" id="ChangingTable">
								<thead>
									<th>Part Name</th>
									<th>Part Preview</th>
									<th>Part Status</th>
									<th>Drama Name</th>
									<th>Drama Preview</th>
									<th>Category Name</th>                                 								
									<th>Artist Name</th>
									<th>Artist Preview</th>
									<th>Actions</th>
								</thead>
							<?php
										
								$conn=oci_connect("system","Oracle_1","//localhost/orcl");

								$query = "SELECT DRAMACONTENT.CID AS PARTID, DRAMACONTENT.DRAMA_CAT_ID, DRAMACONTENT.TITLE, DRAMACONTENT.DRAMA_PREVIEW AS PARTPREVIEW, 
								DRAMACONTENT.STATUS AS PARTSTATUS, DRAMACONTENT.DRAMANAME, DRAMACATEGORY.DRAMA_PREVIEW, DRAMACONTENT.CATEGORY, 
								DRAMACONTENT.ARTIST, DRAMACATEGORY.ARTIST_PREVIEW, DRAMACATEGORY.DRAMA_ROYALITY FROM DRAMACONTENT INNER JOIN DRAMACATEGORY ON 
								(DRAMACATEGORY.DRAMAID = DRAMACONTENT.DRAMA_CAT_ID)
								WHERE (DRAMACONTENT.STATUS = 1) ORDER BY DRAMACONTENT.UPLOAD_DATE DESC";
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
										<td> <?php echo "<img src=".$result_Data['PARTPREVIEW']." height='50' width='50' alt='NA'>"; ?> </td>
										<td> <?php echo $result_Data['PARTSTATUS']; ?> </td>
										<td> <?php echo $result_Data['DRAMANAME']; ?> </td>
										<td> <?php echo "<img src=".$result_Data['DRAMA_PREVIEW']." height='50' width='50' alt='NA'>"; ?> </td>
										<td> <?php echo $result_Data['CATEGORY']; ?> </td>
										<td> <?php echo $result_Data['ARTIST']; ?> </td>
										<td> <?php echo "<img src=".$result_Data['ARTIST_PREVIEW']." height='50' width='50' alt='NA'>"; ?> </td>
										<td> <i class="fa fa-edit" style="font-size:18px" onclick="editEvent(event,'<?php echo $result_Data['PARTID'];?>','<?php echo $result_Data['TITLE'];?>', '<?php echo $result_Data['DRAMA_CAT_ID'];?>', '<?php echo $result_Data['DRAMA_ROYALITY'];?>', '<?php echo $result_Data['PARTSTATUS']; ?>')"></i> <i class="fa fa-trash-o" style="font-size:18px;color:red" onclick="deleteEvent(event,'<?php echo $result_Data['PARTID'];?>')"></i> </td>
									</tr>
								<?php		
									}
								?>
								</tbody>
										
							<?php
								}
								else{
									echo 'Query Didnt Execute';
								}	
								oci_close($conn);
							?>
							</table>
						</div>
					</div>
					
					<div class="clearfix"> </div>
				</div>
			</div>
			
			<!-- footer -->
			<?php include("footerCms.php"); ?>
		</section>
		
		<script>		
			$("button").click(function(e){
				var idClicked = e.target.id;
				//alert(idClicked);
				$.post("action_page.php",{partsForThisCategory : idClicked, status:1},	
					
					function(data, status){	
						var content = "";
						for (i = 0; i < data.length; i++){
							content += "<tr>";
							content += "<td>" + data[i].TITLE + "</td>";
							content += "<td><img src=" + data[i].PARTPREVIEW + " height='50' width='50' alt='None'></td>";
							content += "<td>" + data[i].PARTSTATUS + "</td>";
							content += "<td>" + data[i].DRAMANAME + "</td>";
							content += "<td><img src=" + data[i].DRAMA_PREVIEW + " height='50' width='50' alt='None'></td>";
							content += "<td>" + data[i].CATEGORY + "</td>";
							content += "<td>" + data[i].ARTIST + "</td>";
							content += "<td><img src=" + data[i].ARTIST_PREVIEW + " height='50' width='50' alt='None'></td>";
							content += "<td><i class='fa fa-trash-o' style='font-size:18px;color:red' onclick='deleteEvent(event," + data[i].PARTID + ")'></i></td>";
							content += "</tr>";
							$("#ChangingTable tbody").html(content);
						}
					}
				);
			});
		</script>	
	</body>
</html>
