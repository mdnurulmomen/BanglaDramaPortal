<div id="editForm" class="modal">
	<form class="modal-content animate" id='formEdit' method="POST"  action="action_page.php">
		<div class="container-fluid">
			<div class="imgcontainer">
				<span onclick="document.getElementById('editForm').style.display='none'" class="close" title="Close Modal" style="right: 15px; top: -20px;">&times;</span>
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
			
			<button type="submit"  class="btn btn-success"  name="editPart" value="editPart">Submit</button>
		</div>
		
		<div class="container-fluid" style="background-color:#f1f1f1; text-align:center">
			<button type="button" onclick="document.getElementById('editForm').style.display='none'" class="cancelbtn">Cancel</button>
		</div>
	</form>
</div>

<script>
	var modal = document.getElementById('editForm');
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
</script>
<noscript>Sorry, your browser does not support JavaScript!</noscript>