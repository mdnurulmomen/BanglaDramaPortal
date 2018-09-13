
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
			
			<?php include("dramaName-RoyaltyEditForm.php"); ?>
		
			<div class="main-grid" style="margin-top : 100px; margin-bottom : 100px;">
			
			<?php include("numberContentsEachCategory.php"); ?>
				
				<div class="agile-grids">
					<div class="agile-bottom-grid">
						<div class="col col-sm-3 col-xs-3 text-center">
						  <button class="btn btn-primary btn-block" id='Single'>Single Contents only</button>
						</div>

						<div class="col col-sm-3 col-xs-3 text-center">
						  <button class="btn btn-primary btn-block" id='Serial'>Serial Contents only</button>
						</div>

						<div class="col col-sm-3 col-xs-3 text-center">
						  <button class="btn btn-primary btn-block" id='Artist'>Artist Contents only</button>
						</div>

						<div class="col col-sm-3 col-xs-3 text-center">
						  <button class="btn btn-primary btn-block" id='Featured'>Featured Contents only</button>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				
			<?php include("messageFadeOut.php");?>
				
				<h5 id='deleteStatus' style='text-align:center'></h5>
				
				<div class="agile-two-grids">			
					<div class="agile-bottom-grid">	
						<div class="area-grids-heading">
							<h3>All Categories <i class="fa fa-hand-o-down"></i></h3>
						</div>
					
						<div class="text-center">
							<table class="table table-responsive table-striped table-bordered table-hover" id="ChangingTable">
								<thead>
									<th>Category</th>                                 								                               								
									<th>Drama Name</th>
									<th>Parts Added</th>
									<th>Drama Preview</th>
									<th>Drama Royalty</th>
									<th>Actions</th>
								</thead>
							<?php
								$conn=oci_connect("system","Oracle_1","//localhost/orcl");

								$query = "SELECT DRAMACATEGORY.DRAMAID, DRAMACATEGORY.DRAMANAME, DRAMACATEGORY.CATEGORY, DRAMACATEGORY.DRAMA_PREVIEW, 
								DRAMACATEGORY.DRAMA_ROYALITY, COUNT(DRAMACONTENT.CID) OVER (PARTITION BY DRAMACATEGORY.DRAMAID) AS PERDRAMA FROM 
								DRAMACATEGORY LEFT OUTER JOIN DRAMACONTENT ON (DRAMACATEGORY.DRAMAID=DRAMACONTENT.DRAMA_CAT_ID) ORDER BY DRAMACATEGORY.CATEGORY DESC, DRAMACATEGORY.UPLOAD_DATE DESC";
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
										<td> <?php echo $result_Data['CATEGORY']; ?> </td>
										<td> <?php echo $result_Data['DRAMANAME']; ?> </td>
										<td> <?php echo $result_Data['PERDRAMA']; ?> </td>
										<td> <?php echo "<img src=".$result_Data['DRAMA_PREVIEW']." height='50' width='50' alt='None'>"; ?> </td>
										<td> <?php echo $result_Data['DRAMA_ROYALITY']; ?> </td>
										<td> <i class='fa fa-edit' style='font-size:18px' onclick="editEvent(event, '<?php echo $result_Data['DRAMAID'];?>', '<?php echo $result_Data['DRAMA_ROYALITY'];?>')"></i> <i class="fa fa-trash-o" style="font-size:18px;color:red" onclick="deleteDrama(event,'<?php echo $result_Data['DRAMAID'];?>')"></i> </td>
									</tr>
								<?php
									}
								?>
								</tbody>
							<?php
								}else{
									echo 'Query not Executed';
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
				// alert(idClicked);
				$.post("action_page.php",{onlyThisCategoty : idClicked},	
					
					function(data, status){	
						var content = "";
						for (i = 0; i < data.length; i++){
							// DRAMAID, DRAMANAME, CATEGORY, DRAMA_PREVIEW, DRAMA_ROYALITY
							content += "<tr>";
							content += "<td>" + data[i].CATEGORY + "</td>";
							content += "<td>" + data[i].DRAMANAME + "</td>";
							content += "<td>" + data[i].PERDRAMA + "</td>";
							content += "<td><img src=" + data[i].DRAMA_PREVIEW + " height='50' width='50' alt='None'></td>";
							content += "<td>" + data[i].DRAMA_ROYALITY + "</td>";
							content += "<td><i class='fa fa-trash-o' style='font-size:18px;color:red' onclick='deleteDrama(event," + data[i].DRAMAID + ")'></i></td>";
							content += "</tr>";
							$("#ChangingTable tbody").html(content);
						}
					}
				);
			});
		
			function editEvent(evt,dramaID,dramaRoyaltyName) {
				//alert(partName, dramaName, artistName, partStatus, categoryName, uploaDate);
				document.getElementById('editForm').style.display='block';
				document.getElementById('formEdit').reset();
				document.getElementById("dramaID").value=dramaID;
				document.getElementById("editRoyaltyName").value=dramaRoyaltyName;
				document.getElementsByClassName("hide").style.display = 'none';
			}
		</script>
		<noscript>Sorry, your browser does not support JavaScript!</noscript>
	</body>
</html>
