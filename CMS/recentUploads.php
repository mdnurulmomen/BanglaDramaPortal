<div class="area-grids-heading">
	<h4>Recent Uploads <i class="fa fa-hand-o-down"></i> </h4>
</div>
<div class="text-center">
	<table class="table table-responsive table-striped table-bordered table-hover text-center">
		<thead>
			<th>Part Name</th>
			<th>Drama Name</th>
			<th>Category Name</th>                                								
			<th>Artist Name</th>
			<th>Current Status</th>
			<th>Date</th>
			<th>Actions</th>
		</thead>
	<?php		
		$conn=oci_connect("system","Oracle_1","//localhost/orcl");
		
		$query = "SELECT * FROM(SELECT * FROM(SELECT CID, TITLE, DRAMANAME, DRAMA_CAT_ID, CATEGORY, ARTIST, STATUS, UPLOAD_DATE, 
		ROW_NUMBER() OVER (PARTITION BY DRAMANAME ORDER BY UPLOAD_DATE DESC) RN FROM DRAMACONTENT) WHERE RN <= 2 ORDER BY UPLOAD_DATE DESC)WHERE ROWNUM <= 16";
		
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
				<td> <?php echo $result_Data['TITLE']; ?> </td>
				<td> <?php echo $result_Data['DRAMANAME']; ?> </td>
				<td> <?php echo $result_Data['CATEGORY']; ?> </td>
				<td> <?php echo $result_Data['ARTIST']; ?> </td>
				<td> <?php echo $result_Data['STATUS']; ?> </td>
				<td> <?php echo $result_Data['UPLOAD_DATE']; ?> </td>
				<td> <i class="fa fa-edit" style="font-size:18px" onclick="editEvent(event,'<?php echo $result_Data['CID'];?>','<?php echo $result_Data['TITLE'];?>', '<?php echo $result_Data['STATUS'];?>')"></i> <i class="fa fa-trash-o" style="font-size:18px;color:red" onclick="deleteEvent(event,'<?php echo $result_Data['CID'];?>')"></i> </td>
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
</div>