
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
		<div id="addContentPartsForm" class="modal">
			<form class="modal-content animate" method="POST"  enctype="multipart/form-data" action="action_page.php" id="form">
				<div class="container-fluid">
					<div class="imgcontainer">
						<span onclick="document.getElementById('addContentPartsForm').style.display='none'" class="close" title="Close Modal" style="right: 15px; top: -20px;">&times;</span>
					</div>
					
					<div class="form-group">					
						<label for="categoryName"><b>Category Name</b></label>
						<input type="text" name="categoryName" Id="categoryName" required readonly>
					</div>	
					
					<div class="form-group">
						<label for="select_Content"><b>Select Drama</b></label>
						<select class="form-control" name="selectContent" id="selectContent" required></select>
					</div>
						
						<input type = "hidden" name="contentName" id='contentName' required>
					
					<div class="form-group">
						<label for="Content_Name"><b>Part Name</b></label>
						<input type="text" placeholder="Enter Episode Title" name="episodeName" required>
					</div>
					
					<div class="form-group">
						<label for="contentImage"><b>Upload Part Preview</b></label>
						<input type="file" id="contentImage" name="episodeImage" class="form-control-file" required>
					</div>
					
					<div class="form-group">
						<label for="contentFile"><b>Upload Part File</b></label>
						<input type="file" id="contentFile" name="episodeFile" required>
					</div>
					
					<div id="artistField">
						<div class="form-group">
							<label for="artistName">Artist Name :</label>
							<select class="form-control" name="artistName" id="artistName">
								<option>Abul Hayat</option>
								<option>Afran Nisho</option>
								<option>Afzal Hossain</option>
								<option>Aly Zaker</option>
								<option>Badhon</option>
								<option>Bidya Sinha Mim</option>
								<option>Bindu</option>
								<option>Bipasha Hayat</option>
								<option>Bulbul Ahmed</option>
								<option>Challenger (actor)</option>
								<option>Fazlur Rahman Babu</option>
								<option>Humayun Faridi</option>
								<option>Litu Anam</option>
								<option>Mosharraf Karim</option>
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
					</div>	
					
					<div class="radio">
						<label class="radio-inline">
							<input type="radio" name="status" value="1" >Published
						</label>
						
						<label class="radio-inline">
							<input type="radio" name="status" value="0" checked>Unpublished
						</label>
					</div>
					
					<button type="submit"  class="btn btn-success"  name="addEpisode" value="addEpisode">Submit</button>
				</div>

				<div class="container-fluid" style="background-color:#f1f1f1; text-align:center">
					<button type="button" onclick="document.getElementById('addContentPartsForm').style.display='none'" class="cancelbtn">Cancel</button>
				</div>
			</form>
		
		</div>

		<script>
			window.onclick = function(event) {
				var modal = document.getElementById('addContentPartsForm');
				if (event.target == modal) {
					modal.style.display = 'none';
				}
			}
		</script>
		
	<?php include("dramaPartNameEditForm.php"); ?>
		
	<?php include("dashBoard.php"); ?>	
		
		<section class="wrapper scrollable">
			
		<?php include("banglaDramaCmsHeader.php"); ?>
			
			<div class="main-grid" style="margin-top : 100px; margin-bottom : 100px;">
				<div class="agile-grids">
					<div class="agile-bottom-grid">
						<div class="col col-sm-3 col-xs-3 text-center">
							<button type="button" class="btn btn-primary" onclick="contentsPartsAdding(event,'Single')">Add Single Parts</button>
						</div>
						<div class="col col-sm-3 col-xs-3 text-center">
							<button type="button" class="btn btn-success" onclick="contentsPartsAdding(event,'Serial')">Add Serial Parts</button>
						</div>
						<div class="col col-sm-3 col-xs-3 text-center">
							<button type="button" class="btn btn-primary" onclick="contentsPartsAdding(event,'Artist')">Add Artist Parts</button>
						</div>
						<div class="col col-sm-3 col-xs-3 text-center">
							<button type="button" class="btn btn-success" onclick="contentsPartsAdding(event,'Featured')">Add Featured Parts</button>
						</div>
						
						<div class="clearfix"> </div>
					</div>
				</div>
				
			<?php include("messageFadeOut.php"); ?>	
				
				<h5 id='deleteStatus' style='text-align:center'></h5>
				
				<div class="agile-two-grids">
					<div class="agile-bottom-grid">
					<?php include("recentUploads.php"); ?>							
					</div>
					
					<div class="clearfix"> </div>
				</div>
			</div>
			
			<!-- footer -->
		<?php include("footerCms.php"); ?>
		</section>
		
		<script>
			$('#selectContent').change(function() {
				var selectedcontentId = $( "select#selectContent option:selected" ).val();
				//alert('You Selected :'+selectedcontentId);
				var selectedcontentName = $( "select#selectContent option:selected" ).text();	
				$('#contentName').val(selectedcontentName);
				
				var theArtist = document.getElementById('artistName');
				theArtist.innerHTML = '';
				$.post("action_page.php",{selectedcontentId : selectedcontentId},
					function(data, status){
						//alert(data);
						newOption = document.createElement('option');
						newOption.value = data;
						newOption.textContent = data;
						theArtist.appendChild(newOption);
					}
				);
			});
		</script>
	</body>
</html>
