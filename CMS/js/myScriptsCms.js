			
			function createContent(evt, catagoryName) {
				var artist= catagoryName.localeCompare('Artist');
				if(artist==0){
					document.getElementById('createContentForm').style.display='block'
					document.getElementById("categoryName").value=catagoryName;
					document.getElementById("artistField").style.display='block';
					document.getElementById("artistName").required=true;
					document.getElementById("artistImage").required=true;
				}
				else{
					document.getElementById('createContentForm').style.display='block'
					document.getElementById("categoryName").value=catagoryName;
					document.getElementById("artistField").style.display='none';
				}
			}
			
			function contentsPartsAdding(evt, categoryName) {
				
				document.getElementById("form").reset();
				var artist= categoryName.localeCompare('Artist');
				
				if(artist==0){
					document.getElementById('addContentPartsForm').style.display='block'
					document.getElementById("categoryName").value=categoryName;
					document.getElementById("artistField").style.display='block';
				}
				else {	
					document.getElementById('addContentPartsForm').style.display='block'
					document.getElementById("categoryName").value=categoryName;
					document.getElementById("artistField").style.display='none';
				}
					
				var contents = document.getElementById('selectContent');
				contents.innerHTML = '<option disabled selected value>  select an option  </option>';
					
				$.post("action_page.php",{contentSelectionCategory : categoryName},

					function(data, status){
						//alert(data);
						for (i = 0; i < data.length; i++){
							newOption = document.createElement('option');
							//newOption.value = data[i].DRAMANAME;
							newOption.value = data[i].DRAMAID;
							newOption.textContent = data[i].DRAMANAME;
							contents.appendChild(newOption);
						}
					}
				);
			}
			
			function editEvent(evt, partId, partName, partStatus) {
				
				document.getElementById('editForm').style.display='block';
				document.getElementById('formEdit').reset();
				
				document.getElementById("editEpisodeName").value=partName;
				document.getElementById("partID").value=partId;
				
				document.getElementsByClassName("hide").style.display = 'none';

			}
			
			function editEvent(evt, dramaID, dramaRoyaltyName) {
				
				document.getElementById('editForm').style.display='block';
				document.getElementById('formEdit').reset();
				
				document.getElementById("dramaID").value=dramaID;
				document.getElementById("editRoyaltyName").value=dramaRoyaltyName;
				
				document.getElementsByClassName("hide").style.display = 'none';
		
			}
			
			function editEvent(evt, partId, partName, dramaID, dramaRoyalty, partStatus) {

				document.getElementById('editForm').style.display='block';
				document.getElementById('formEdit').reset();
				
				document.getElementById("partID").value=partId;
				document.getElementById("editEpisodeName").value=partName;
				document.getElementById("dramaID").value=dramaID;
				document.getElementById("dramaRoyalty").value=dramaRoyalty;
				
				document.getElementsByClassName("hide").style.display = 'none';
				//document.getElementById("editStatus").value=dramaID;
			}
			
			$(document).ready(function(){
				$("#messageFadeOut").fadeOut(5000);
			});
			
			
			function deleteEvent(evt, partId) {
				if (confirm(" Delete this Part ??!")) {
					$.post("action_page.php",{partIdToDelete : partId},
						function(data, status){
							location.reload();
							$("#deleteStatus").text(data);
							$("#deleteStatus").fadeOut(5000);
						}
					);
				}
				else {
					// $("#deleteStatus").text('Post Method Failed');
					// $("#deleteStatus").fadeOut(5000);
				}	
			}
			
			function deleteDrama(evt, dramaID) {
				if (confirm("Delete Drama ?? ")) {
					$.post("action_page.php",{dramaIdToDelete : dramaID},
						function(data, status){
							//alert(data);
							location.reload();
							$("#deleteStatus").text(data);
							$("#deleteStatus").fadeOut(5000);
						}
					);
				}
				else {
					// $("#deleteStatus").text('Post Method Failed');
					// $("#deleteStatus").fadeOut(5000);
				}	
			}
			