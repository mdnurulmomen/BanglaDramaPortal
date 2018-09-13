<div id="editForm" class="modal">
	<form class="modal-content animate" id='formEdit' method="POST" action="action_page.php">
		<div class="container-fluid">
			<div class="imgcontainer">
				<span onclick="document.getElementById('editForm').style.display='none'" class="close" title="Close Modal" style="right: 15px; top: -20px;">&times;</span>
			</div>
			
			<div class="form-group hide">
				<label for="Drama_Name"><b>Drama ID</b></label>
				<input type="text" name="dramaID" Id="dramaID" required readonly>
			</div>
			
			<div class="form-group">
				<label for="Drama_Royalty"><b>Drama Royalty</b></label>
				<input type="text" name="editRoyaltyName" id="editRoyaltyName"  required>
			</div>
			
			<button type="submit"  class="btn btn-success" name="editDrama" value="editDrama">Submit</button>
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