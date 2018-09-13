
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
		
		<div id="createContentForm" class="modal">
			<form class="modal-content animate" method="POST" enctype="multipart/form-data"  action="action_page.php">
				<div class="container-fluid">
					<div class="imgcontainer">
						<span onclick="document.getElementById('createContentForm').style.display='none'" class="close" title="Close Modal" style="right: 15px; top: -20px;">&times;</span>
					</div>
					
					<div class="form-group">					
						<label for="categoryName"><b>Category Name</b></label>
						<input type="text" placeholder="Enter Contents Category" name="categoryName" readonly Id="categoryName" required>
					</div>	
					
					<div class="form-group">
						<label for="Content_Category"><b>New Content Name</b></label>
						<input type="text" placeholder="Enter Content Name" name="contentName" Id="contentName" required>
					</div>
					
					<div class="form-group">
						<label for="contentPreview"><b>Upload Content Preview</b></label>
						<input type="file" id="contentPreview" name="contentImage" class="form-control-file" required>
					</div>
					
					<div id="artistField">
						<div class="form-group">
							<label for="artistName">Artist Name :</label>
							<select class="form-control" name="artistName" id="artistName">
								<option>Abul Hayat</option>
								<option>Afran Nisho</option>
								<option>Afzal Hossain</option>
								<option>Ahona</option>
								<option>Aly Zaker</option>
								<option>Badhon</option>
								<option>Bidya Sinha Mim</option>
								<option>Bindu</option>
								<option>Bipasha Hayat</option>
								<option>Bulbul Ahmed</option>
								<option>Challenger (actor)</option>
								<option>Chanchal Chowdhury</option>
								<option>Fazlur Rahman Babu</option>
								<option>Humayun Faridi</option>
								<option>Litu Anam</option>
								<option>Mosharraf Karim</option>
								<option>Mehzabin</option>
								<option>Mir Sabbir</option>
								<option>Mishu Sabbir</option>
								<option>Mithila</option>
								<option>Moushumi</option>
								<option>Nadia Ahmed</option>
								<option>Nodi</option>
								<option>Nova</option>
								<option>Opi Karim</option>
								<option>Purnima</option>
								<option>Sarika</option>
								<option>Tahsan</option>
								<option>Tarin Ahmed</option>
								<option>Zakia Bari Momo</option>
								<option>Ziaul Faruq Apurba</option>
							</select>
						</div> 
						
						<div class="form-group">
							<label for="artistPreview"><b>Upload Artist Preview</b></label>
							<input type="file" id="artistImage" name="artistImage" class="form-control-file">
						</div>
					</div>	
					
					<div class="form-group">
						<label for="Drama_Royalty"><b>Royalty</b></label>
						<input type="text" name="dramaRoyaltyName" id="dramaRoyaltyName"  required>
					</div>
					
					<button type="submit" class="btn btn-success" name="createContent" value="createContent">Submit</button>
				</div>

				<div class="container-fluid" style="background-color:#f1f1f1; text-align:center">
					<button type="button" onclick="document.getElementById('createContentForm').style.display='none'" class="cancelbtn">Cancel</button>
				</div>
			</form>
		</div>

		<script>
			window.onclick = function(event) {
				var modal = document.getElementById('createContentForm');
				if (event.target == modal) {
					modal.style.display = 'none';
				}
			}
		</script>
		<noscript>Sorry, your browser does not support JavaScript!</noscript>
		
	<?php include("dramaName-RoyaltyEditForm.php"); ?>
		
		<section class="wrapper scrollable">
			
		<?php include("banglaDramaCmsHeader.php"); ?>
			
			<div class="main-grid" style="margin-top : 100px; margin-bottom : 100px;">
				
			<?php include("numberContentsEachCategory.php"); ?>
				
				<div class="agile-grids">
				
					<p class="asPointLine">Create Drama on Category <i class="fa fa-hand-o-down"></i></p>
					
					<div class="agile-bottom-grid">
						<div class="col col-sm-3 col-xs-3 text-center">
							<button type="button" class="btn btn-success " onclick="createContent(event,'Single')">Single</button>
						</div>
						<div class="col col-sm-3 col-xs-3 text-center">
							<button type="button" class="btn btn-success " onclick="createContent(event,'Serial')">Serial</button>
						</div>
						<div class="col col-sm-3 col-xs-3 text-center">
							<button type="button" class="btn btn-success" onclick="createContent(event,'Artist')">Artist</button>
						</div>
						<div class="col col-sm-3 col-xs-3 text-center">
							<button type="button" class="btn btn-success" onclick="createContent(event,'Featured')">Featured</button>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				
			<?php include("messageFadeOut.php"); ?>	
				
				<h5 id='deleteStatus' style='text-align:center'></h5>
				
				<div class="agile-two-grids">
					<div class="agile-bottom-grid">	
						<div class="area-grids-heading">
							<h3>Recent Contents</h3>
						</div>
						<div class="text-center">
							<table class="table table-responsive table-striped table-bordered table-hover">
								<thead>
									<th>Drama Name</th>
									<th>Drama Category</th>
									<th>Drama Preview</th>
									<th>Artist Name</th>
									<th>Drama Royalty</th>                              								
									<th>Date</th>
									<th>Actions</th>
								</thead>
							<?php		
								$conn=oci_connect("system","Oracle_1","//localhost/orcl");
								$query = "SELECT * FROM(SELECT * FROM DRAMACATEGORY ORDER BY UPLOAD_DATE DESC) WHERE ROWNUM <= 15";
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
										<td> <?php echo $result_Data['DRAMANAME']; ?> </td>
										<td> <?php echo $result_Data['CATEGORY']; ?> </td>
										<td> <?php echo "<img src=".$result_Data['DRAMA_PREVIEW']." height='50' width='50' alt='None'>"; ?> </td>
										<td> <?php echo $result_Data['ARTIST']; ?> </td>
										<td> <?php echo $result_Data['DRAMA_ROYALITY']; ?> </td>
										<td> <?php echo $result_Data['UPLOAD_DATE']; ?> </td>
										<td> <i class="fa fa-edit" style="font-size:18px" onclick="editEvent(event, '<?php echo $result_Data['DRAMAID'];?>', '<?php echo $result_Data['DRAMA_ROYALITY'];?>')"></i> <i class="fa fa-trash-o" style="font-size:18px;color:red" onclick="deleteDrama(event,'<?php echo $result_Data['DRAMAID'];?>')"></i> </td>
									</tr>
								<?php		
									}
								?>
								</tbody>
							<?php	
								}
								else{
									echo 'Query Not Execute';
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
			function editEvent(evt, dramaID, dramaRoyaltyName) {
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
