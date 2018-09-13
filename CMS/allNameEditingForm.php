<div id="editForm" class="modal">
	<form class="modal-content animate" id='formEdit' method="POST"  action="action_page.php">
		<div class="container-fluid">
			<div class="imgcontainer">
				<span onclick="document.getElementById('editForm').style.display='none'" class="close" title="Close Modal" style="right: 15px; top: -20px;">&times;</span>
			</div>
		
			<div class="form-group hide">
				<label for="Drama_ID"><b>Drama ID</b></label>
				<input type="text" name="dramaID" Id="dramaID" required readonly>
			</div>
			
			<div class="form-group">
				<label for="Drama_Royalty"><b>Drama Royalty</b></label>
				<input type="text" name="dramaRoyalty" id="dramaRoyalty"  required>
			</div>
			
			<div class="form-group">
				<label for="Part_Name"><b>Part Name</b></label>
				<input type="text" name="editEpisodeName" id="editEpisodeName"  required>
			</div>
			
			<div class="form-group hide">
				<label for="Part_ID"><b>Part ID</b></label>
				<input type="text" name="partID" id='partID' required readonly>
			</div>
			
			<div class="radio">
				<label class="radio-inline">
					<input type="radio" name="editStatus" value="1" required>Published
				</label>
				
				<label class="radio-inline">
					<input type="radio" name="editStatus" value="0" checked>Unpublished
				</label>
			</div>	
			
			<button type="submit" class="btn btn-success" name="editAllContent" value="editAllContent">Submit</button>
		</div>
		
		<div class="container-fluid" style="background-color:#f1f1f1; text-align:center">
			<button type="button" onclick="document.getElementById('editForm').style.display='none'" class="cancelbtn">Cancel</button>
		</div>
	</form>
</div>