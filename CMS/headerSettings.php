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
			
			<div class="main-grid" style="margin-top : 100px; margin-bottom : 100px;">
				
				<?php include("messageFadeOut.php"); ?>	
				
				<div class="agile-grids">
					<div class="agile-bottom-grid">
						<div class='container-fluid'>
							<div class='row'>
								<div class='col-md-5 col-sm-5 col-xs-5' style='margin:1px; padding:1px;'>
									<h4>All Main Previews <i class="fa fa-hand-o-down"></i></h4>
									<form id='headerFormAdding' method='POST'  action='action_page.php'>
										<table class="table table-hover table-responsive table-striped">
										<?php
												
										$conn=oci_connect("system","Oracle_1","//localhost/orcl");
										$query = "SELECT DRAMAID, DRAMANAME, DRAMA_PREVIEW FROM DRAMACATEGORY WHERE CATEGORY NOT IN ('Artist') ORDER BY UPLOAD_DATE DESC";
										$parsed_Query = oci_parse($conn,$query);
										$success = oci_execute($parsed_Query);

										if($success){
										?>	
											<thead>
											<th>Mark</th>
											<th>Drama Previews</th>
											<th>Drama Name</th>                          								
											</thead>
											
											<tbody>
												<?php
													while($result_Data = oci_fetch_assoc($parsed_Query))
													{
												?>
													<tr>
														<td> <input type="checkbox" name="dramaName[]" value="<?php echo $result_Data['DRAMAID']; ?>" >  </td>
														<td> <?php echo "<img src=".$result_Data['DRAMA_PREVIEW']." height='42' width='42' alt='None'>"; ?> </td>
														<td> <?php echo $result_Data['DRAMANAME']; ?> </td>
													</tr>
												<?php		
													}
												?>	
											</tbody>
											
										<?php	
										}
										else{
											
											echo 'Execution Failed';
										}
										oci_close($conn);			
										?>
										</table>
										<button type="submit" name="headerFormAdding" value="headerFormAdding" class="btn btn-primary">Add</button>
									</form>
								</div>
								
								<div class='col-md-1 col-sm-1 col-xs-1' style='margin:1px; padding:1px;'></div>
								
								<div class='col-md-5 col-sm-5 col-xs-5' style='margin:1px; padding:1px;'>
										
									<h4>Selected Previews for Heading <i class="fa fa-hand-o-down"></i></h4>
									<form id='headerFormAdding' method='POST'  action='action_page.php'>
										<table class="table table-hover table-responsive table-striped">
										<?php
												
										$conn=oci_connect("system","Oracle_1","//localhost/orcl");
							
										$query = "SELECT DRAMAID, DRAMANAME, DRAMA_PREVIEW FROM DRAMACATEGORY WHERE STATUS IS NOT null";
										$parsed_Query = oci_parse($conn,$query);
										$success = oci_execute($parsed_Query);

										if($success){
										?>	
											<thead>
											<th>Mark</th>
											<th>Drama Previews</th>
											<th>Drama Name</th>                          								
											</thead>
											
											<tbody>
												<?php
													while($result_Data = oci_fetch_assoc($parsed_Query))
													{
												?>
													<tr>
														<td> <input type="checkbox" name="dramaName[]" value="<?php echo $result_Data['DRAMAID']; ?>">  </td>
														<td> <?php echo "<img src=".$result_Data['DRAMA_PREVIEW']." height='42' width='42' alt='None'>"; ?> </td>
														<td> <?php echo $result_Data['DRAMANAME']; ?> </td>
													</tr>
												<?php		
													}
												?>	
											</tbody>
										<?php	
										}
										else{
											
											echo 'Execution Failed';
										}
										oci_close($conn);			
										?>
										</table>
										<button type="submit" name="headerFormRemoving" value="headerFormRemoving" class="btn btn-primary" onClick="return empty()" />Remove</button>
									</form>
								</div>
							</div>
						</div>	
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
			
			<!-- footer -->
			<?php include("footerCms.php"); ?>
		</section>
		
		<script>
			
			function empty() {
				//alert('ShakeR');
				var x = document.getElementsByName("dramaName").value;
				if (x == "") {
					alert("Enter a Valid Roll Number");
					return false;
				};
			}
		</script>
		<noscript>Sorry, your browser does not support JavaScript!</noscript>
	</body>
</html>
