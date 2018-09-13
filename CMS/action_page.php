
	<?php 
		$conn=oci_connect("system","Oracle_1","//localhost/orcl");
	?>

	<?php
	
		if (isset($_POST['createContent'])) {
			$categoryName = trim($_POST["categoryName"]);
			$contentName = trim($_POST["contentName"]);
			$artistImage_path = 'unmentioned';
			$artistName = 'unmentioned';

			$charachtersToRemove = array('"', ' ', '|', '"');
			if(strcmp($categoryName,"Single")==0){	
				$content_dir = "../Front-End/repository/single/".str_replace($charachtersToRemove, '_', $contentName);
				if (!file_exists($content_dir)) {
					mkdir($content_dir);
				}else{
					
				}
				
				$contentImageName = $_FILES["contentImage"]["name"];
				$contentExtension =  pathinfo($contentImageName,PATHINFO_EXTENSION);
				$contentNewName =  str_replace($charachtersToRemove, '_', $contentName).'.'.$contentExtension;
				$contentImage_dir = "../Front-End/repository/dramaPreview/";
				//$contentImage_path = $contentImage_dir.basename($_FILES["contentImage"]["name"]);				
				$contentImage_path = $contentImage_dir.$contentNewName;				
				
				if (!file_exists($contentImage_path)) {
					move_uploaded_file($_FILES["contentImage"]["tmp_name"], $contentImage_path);
				}else{

				}
			}
			else if(strcmp($categoryName,"Featured")==0){
				$content_dir = "../Front-End/repository/featured/".str_replace($charachtersToRemove, '_', $contentName);
				if (!file_exists($content_dir)) {
					mkdir($content_dir);
				}else{
					
				}
			
				$contentImageName = $_FILES["contentImage"]["name"];
				$contentExtension =  pathinfo($contentImageName,PATHINFO_EXTENSION);
				$contentNewName =  str_replace($charachtersToRemove, '_', $contentName).'.'.$contentExtension;
				$contentImage_dir = "../Front-End/repository/dramaPreview/";
				//$contentImage_path = $contentImage_dir.basename($_FILES["contentImage"]["name"]);				
				$contentImage_path = $contentImage_dir.$contentNewName;	
				
				if (!file_exists($contentImage_path)) {
					move_uploaded_file($_FILES["contentImage"]["tmp_name"], $contentImage_path);
				}else{

				}
			}
			else if(strcmp($categoryName,"Artist")==0){	
			
				$artistName = $_POST["artistName"];
				
				$artistImageName = $_FILES["artistImage"]["name"];
				$artistImageExtension =  pathinfo($artistImageName,PATHINFO_EXTENSION);
				$artistImageNewName =  str_replace($charachtersToRemove, '_', $artistName).'.'.$artistImageExtension;
				$artistImage_dir = "../Front-End/repository/artistPreview/";
				//$contentImage_path = $contentImage_dir.basename($_FILES["contentImage"]["name"]);				
				$artistImage_path = $artistImage_dir.$artistImageNewName;	
				
				if (!file_exists($artistImage_path)){
					move_uploaded_file($_FILES["artistImage"]["tmp_name"], $artistImage_path);
				}else{
					
				}
				
				$contentImage_dir = "../Front-End/repository/artist/".str_replace($charachtersToRemove, '_', $contentName);
				if (!file_exists($contentImage_dir)) {
					mkdir($contentImage_dir);
				}else{
					
				}
			
				$contentImageName = $_FILES["contentImage"]["name"];
				$contentExtension =  pathinfo($contentImageName,PATHINFO_EXTENSION);
				$contentNewName =  str_replace($charachtersToRemove, '_', $contentName).'.'.$contentExtension;
				
				$contentImage_path = $contentImage_dir.'/'.$contentNewName;	
				
				if (!file_exists($contentImage_path)) {
					move_uploaded_file($_FILES["contentImage"]["tmp_name"], $contentImage_path);
				}else{

				}
			}
			
			else{
				$content_dir = "../Front-End/repository/serial/".str_replace($charachtersToRemove, '_', $contentName);
				if (!file_exists($content_dir)) {
					mkdir($content_dir);
					
				}else{
					
				}
			
				$contentImageName = $_FILES["contentImage"]["name"];
				$contentExtension =  pathinfo($contentImageName,PATHINFO_EXTENSION);
				$contentNewName =  str_replace($charachtersToRemove, '_', $contentName).'.'.$contentExtension;
				$contentImage_dir = "../Front-End/repository/dramaPreview/";
				//$contentImage_path = $contentImage_dir.basename($_FILES["contentImage"]["name"]);				
				$contentImage_path = $contentImage_dir.$contentNewName;
				
				if (!file_exists($contentImage_path)) {
					move_uploaded_file($_FILES["contentImage"]["tmp_name"], $contentImage_path);
					
				}else{

				}
			}
			
			$dramaRoyalty = $_POST["dramaRoyaltyName"];
			
			$query = "INSERT INTO DRAMACATEGORY(DRAMANAME,CATEGORY,DRAMA_PREVIEW, ARTIST, ARTIST_PREVIEW, DRAMA_ROYALITY)
			VALUES('$contentName', '$categoryName', '$contentImage_path', '$artistName', '$artistImage_path', '$dramaRoyalty')";
			$parsed_Query = oci_parse($conn,$query);
			$success = oci_execute($parsed_Query);
			
			if($success){
				$Message = "Successfully Drama Created";
				header("Location:createContent.php?message={$Message}");
			}
			else {
				$Message = "Drama Creation is Failed";
				header("Location:createContent.php?message={$Message}");
			}
		}
		
		if (isset($_POST['addEpisode'])) {
			
			$categoryName = $_POST["categoryName"];
			$selectedContentId = $_POST["selectContent"];
			$selectedContentName = $_POST["contentName"];
			$episodeName = $_POST["episodeName"];
			
			$artistName = 'unmentioned';
			
			$charachtersToRemove = array('"', ' ', '|', '"');
			if(strcmp($categoryName,"Single")==0){
				
				//categoryName, selectContent, contentName, episodeName, episodeImage, episodeFile, artistName, status
				$episodeImageName = $_FILES["episodeImage"]["name"];
				$episodeImageNameExtension =  pathinfo($episodeImageName,PATHINFO_EXTENSION);
				$episodeImageNewName =  str_replace($charachtersToRemove, '_', $selectedContentName).'-'.str_replace($charachtersToRemove, '_', $episodeName).'.'.$episodeImageNameExtension;
				$episodeImage_dir = "../Front-End/repository/single/".str_replace($charachtersToRemove, '_', $selectedContentName)."/";
				$episodeImage_path = $episodeImage_dir.$episodeImageNewName;
				
				if (!file_exists($episodeImage_path)) {
					move_uploaded_file($_FILES["episodeImage"]["tmp_name"], $episodeImage_path);
				}else{
					
				}
					
				$episodeFileName = $_FILES["episodeFile"]["name"];
				$episodeFileNameExtension =  pathinfo($episodeFileName,PATHINFO_EXTENSION);
				$episodeFileNewName =  str_replace($charachtersToRemove, '_', $selectedContentName).'-'.str_replace($charachtersToRemove, '_', $episodeName).'.'.$episodeFileNameExtension;
				$episodeFile_dir = "../Front-End/repository/single/".str_replace($charachtersToRemove, '_', $selectedContentName)."/";
				$episodeFile_path = $episodeFile_dir.$episodeFileNewName;
				
				if (!file_exists($episodeFile_path)) {
					move_uploaded_file($_FILES["episodeFile"]["tmp_name"], $episodeFile_path);
				}else{
					
				}
			}
			
			else if(strcmp($categoryName,"Featured")==0){
				//$content_dir = "Contents/Featured_Drama/".str_replace($charachtersToRemove, '_', $selectedContentName);
				$episodeImageName = $_FILES["episodeImage"]["name"];
				$episodeImageNameExtension =  pathinfo($episodeImageName,PATHINFO_EXTENSION);
				$episodeImageNewName =  str_replace($charachtersToRemove, '_', $selectedContentName).'-'.str_replace($charachtersToRemove, '_', $episodeName).'.'.$episodeImageNameExtension;
				$episodeImage_dir = "../Front-End/repository/featured/".str_replace($charachtersToRemove, '_', $selectedContentName)."/";
				$episodeImage_path = $episodeImage_dir.$episodeImageNewName;
				
				if (!file_exists($episodeImage_path)) {
					move_uploaded_file($_FILES["episodeImage"]["tmp_name"], $episodeImage_path);
				}else{
					
				}
					
				$episodeFileName = $_FILES["episodeFile"]["name"];
				$episodeFileNameExtension =  pathinfo($episodeFileName,PATHINFO_EXTENSION);
				$episodeFileNewName =  str_replace($charachtersToRemove, '_', $selectedContentName).'-'.str_replace($charachtersToRemove, '_', $episodeName).'.'.$episodeFileNameExtension;
				$episodeFile_dir = "../Front-End/repository/featured/".str_replace($charachtersToRemove, '_', $selectedContentName)."/";
				$episodeFile_path = $episodeFile_dir.$episodeFileNewName;
				
				if (!file_exists($episodeFile_path)) {
					move_uploaded_file($_FILES["episodeFile"]["tmp_name"], $episodeFile_path);
				}else{
					
				}	
			}
			
			else if(strcmp($categoryName,"Artist")==0){	
				
				$artistName = $_POST["artistName"];
				
				$episodeImageName = $_FILES["episodeImage"]["name"];
				$episodeImageNameExtension =  pathinfo($episodeImageName,PATHINFO_EXTENSION);
				$episodeImageNewName =  str_replace($charachtersToRemove, '_', $selectedContentName).'-'.str_replace($charachtersToRemove, '_', $episodeName).'.'.$episodeImageNameExtension;
				$episodeImage_dir = "../Front-End/repository/artist/".str_replace($charachtersToRemove, '_', $selectedContentName)."/";
				$episodeImage_path = $episodeImage_dir.$episodeImageNewName;
				
				if (!file_exists($episodeImage_path)) {
					move_uploaded_file($_FILES["episodeImage"]["tmp_name"], $episodeImage_path);
				}else{
					
				}
					
				$episodeFileName = $_FILES["episodeFile"]["name"];
				$episodeFileNameExtension =  pathinfo($episodeFileName,PATHINFO_EXTENSION);
				$episodeFileNewName =  str_replace($charachtersToRemove, '_', $selectedContentName).'-'.str_replace($charachtersToRemove, '_', $episodeName).'.'.$episodeFileNameExtension;
				$episodeFile_dir = "../Front-End/repository/artist/".str_replace($charachtersToRemove, '_', $selectedContentName)."/";
				$episodeFile_path = $episodeFile_dir.$episodeFileNewName;
				
				if (!file_exists($episodeFile_path)) {
					move_uploaded_file($_FILES["episodeFile"]["tmp_name"], $episodeFile_path);
				}else{
					
				}
				
			}
			
			else{
				
				$episodeImageName = $_FILES["episodeImage"]["name"];
				$episodeImageNameExtension =  pathinfo($episodeImageName,PATHINFO_EXTENSION);
				$episodeImageNewName =  str_replace($charachtersToRemove, '_', $selectedContentName).'-'.str_replace($charachtersToRemove, '_', $episodeName).'.'.$episodeImageNameExtension;
				$episodeImage_dir = "../Front-End/repository/serial/".str_replace($charachtersToRemove, '_', $selectedContentName)."/";
				$episodeImage_path = $episodeImage_dir.$episodeImageNewName;
				
				if (!file_exists($episodeImage_path)) {
					move_uploaded_file($_FILES["episodeImage"]["tmp_name"], $episodeImage_path);
				}else{
					
				}
					
				$episodeFileName = $_FILES["episodeFile"]["name"];
				$episodeFileNameExtension =  pathinfo($episodeFileName,PATHINFO_EXTENSION);
				$episodeFileNewName =  str_replace($charachtersToRemove, '_', $selectedContentName).'-'.str_replace($charachtersToRemove, '_', $episodeName).'.'.$episodeFileNameExtension;
				$episodeFile_dir = "../Front-End/repository/serial/".str_replace($charachtersToRemove, '_', $selectedContentName)."/";
				$episodeFile_path = $episodeFile_dir.$episodeFileNewName;
				
				if (!file_exists($episodeFile_path)) {
					move_uploaded_file($_FILES["episodeFile"]["tmp_name"], $episodeFile_path);
				}else{
					
				}	
			}
			
			$status = $_POST["status"];
			//categoryName, selectContent, contentName, episodeName, episodeImage, episodeFile, artistName, status
			$query = "INSERT INTO DRAMACONTENT(TITLE, DRAMANAME, DRAMA_CAT_ID, CATEGORY, DRAMA_PREVIEW, DRAMA_FILEPATH, ARTIST, STATUS)
			VALUES('$episodeName', '$selectedContentName', '$selectedContentId', '$categoryName', '$episodeImage_path', '$episodeFile_path', '$artistName', '$status')";
			$parsed_Query = oci_parse($conn,$query);
			$success = oci_execute($parsed_Query);
			
			if($success){
				$Message = "Part is Added Successfully ";
				header("Location:addContent.php?message={$Message}");
			}
			else {
				$Message = "Part Addition is Failed";
				header("Location:addContent.php?message={$Message}");
			}
		}
	
		if (isset($_POST["contentSelectionCategory"])) {
			
			$categorySelected = $_POST["contentSelectionCategory"];
			$query = "SELECT * from DRAMACATEGORY where CATEGORY= '$categorySelected'";
			$parsed_Query = oci_parse($conn,$query);
			$success = oci_execute($parsed_Query);
			header("Content-Type: application/json");
			if($success){
				while($result_Data = oci_fetch_assoc($parsed_Query))
				{
					$results[] = $result_Data;
					//$resultsID[] = $result_Name['DRAMANAME'].'('.$result_Name['DRAMAID'].')';
				}
			}
			echo json_encode($results);
		}
		
		if (isset($_POST["selectedcontentId"])) {
			
			$contentSelected = $_POST["selectedcontentId"];
			$query = "SELECT ARTIST from DRAMACATEGORY where DRAMAID = $contentSelected";
			$parsed_Query = oci_parse($conn,$query);
			$success = oci_execute($parsed_Query);
	
			if($success){
				$result_Data = oci_fetch_assoc($parsed_Query);
				echo $result_Data['ARTIST'];
			}
			else {
				echo 'No Result';
			}	
		}
		
		if (isset($_POST["onlyThisCategoty"])) {
			
			$onlyThisCategoty = $_POST["onlyThisCategoty"];
					
			$query = "SELECT DRAMACATEGORY.DRAMAID, DRAMACATEGORY.DRAMANAME, DRAMACATEGORY.CATEGORY, DRAMACATEGORY.DRAMA_PREVIEW, 
			DRAMACATEGORY.DRAMA_ROYALITY, COUNT(DRAMACONTENT.CID) OVER (PARTITION BY DRAMACATEGORY.DRAMAID) AS PERDRAMA FROM 
			DRAMACATEGORY LEFT OUTER JOIN DRAMACONTENT ON (DRAMACATEGORY.DRAMAID=DRAMACONTENT.DRAMA_CAT_ID) WHERE DRAMACATEGORY.CATEGORY = '$onlyThisCategoty' ORDER BY DRAMACATEGORY.UPLOAD_DATE DESC";
			
			$parsed_Query = oci_parse($conn,$query);
			$success = oci_execute($parsed_Query);
			header("Content-Type: application/json");
			
			if($success){
				while($result_Data = oci_fetch_assoc($parsed_Query))
				{
					$results[] = $result_Data;
				}
			}
			echo json_encode($results);
		}
		
		if (isset($_POST["partsForThisCategory"], $_POST["status"])) {
			
			$partsForThisCategory = $_POST["partsForThisCategory"];
			$status = $_POST["status"];
								
			$query = "SELECT DRAMACONTENT.CID AS PARTID, DRAMACONTENT.DRAMA_CAT_ID, DRAMACONTENT.TITLE, DRAMACONTENT.DRAMA_PREVIEW AS PARTPREVIEW, 
			DRAMACONTENT.STATUS AS PARTSTATUS, DRAMACONTENT.DRAMANAME, DRAMACATEGORY.DRAMA_PREVIEW, DRAMACONTENT.CATEGORY, 
			DRAMACONTENT.ARTIST, DRAMACATEGORY.ARTIST_PREVIEW, DRAMACATEGORY.DRAMA_ROYALITY FROM DRAMACONTENT INNER JOIN DRAMACATEGORY ON 
			(DRAMACATEGORY.DRAMAID = DRAMACONTENT.DRAMA_CAT_ID)
			WHERE (DRAMACONTENT.STATUS = '$status' AND DRAMACONTENT.CATEGORY = '$partsForThisCategory') ORDER BY DRAMACONTENT.UPLOAD_DATE DESC";
			
			$parsed_Query = oci_parse($conn,$query);
			$success = oci_execute($parsed_Query);
			header("Content-Type: application/json");					
			if($success){
				while($result_Data = oci_fetch_assoc($parsed_Query))
				{
					$results[] = $result_Data;
				}
			}
			echo json_encode($results);
		}
		
		
		if (isset($_POST["editPart"])) {
			
			$episodeName = $_POST["editEpisodeName"];
			$partID = $_POST["partID"];
			$status = $_POST["editStatus"];
			
			$query = "UPDATE DRAMACONTENT SET TITLE = '$episodeName', STATUS = '$status' WHERE CID = '$partID'";
			$parsed_Query = oci_parse($conn,$query);
			$success = oci_execute($parsed_Query);

			if($success){
				$Message = "Successfully Edited";
				header("Location:{$_SERVER['HTTP_REFERER']}?message={$Message}");
			}
			else {
				$Message = "Edition Not-Successful";
				header("Location:{$_SERVER['HTTP_REFERER']}?message={$Message}");
			}
		}
		
		if (isset($_POST["editDrama"])){
			//dramaName, dramaID, editRoyaltyName, editDrama
			$dramaID = $_POST["dramaID"];
			$dramaRoyalty = $_POST["editRoyaltyName"];
			
			$query = "UPDATE DRAMACATEGORY SET DRAMA_ROYALITY = '$dramaRoyalty' WHERE DRAMAID = '$dramaID'";
			$parsed_Query = oci_parse($conn,$query);
			$success = oci_execute($parsed_Query);
			
			if($success){
				$Message = "Successfully Edited";
				header("Location:{$_SERVER['HTTP_REFERER']}?message={$Message}");
			}
			else {
				
			}
		}
		
		if (isset($_POST["editAllContent"])) {
			
			$dramaID = $_POST["dramaID"];
			$dramaRoyalty = $_POST["dramaRoyalty"];
			$episodeName = $_POST["editEpisodeName"];
			$partID = $_POST["partID"];
			$status = $_POST["editStatus"];
			
			$query = "UPDATE DRAMACONTENT SET TITLE = '$episodeName', STATUS = '$status' WHERE CID = '$partID'";
			$parsed_Query = oci_parse($conn,$query);
			$success1 = oci_execute($parsed_Query);
			
			$query = "UPDATE DRAMACATEGORY SET DRAMA_ROYALITY = '$dramaRoyalty' WHERE DRAMAID = '$dramaID'";
			$parsed_Query = oci_parse($conn,$query);
			$success2 = oci_execute($parsed_Query);
			
			if($success1.$success2){
				$Message = "Successfully Edited";
				header("Location:{$_SERVER['HTTP_REFERER']}?message={$Message}");
			}
			else{
				$Message = "Edition Not-Successful";
				header("Location:{$_SERVER['HTTP_REFERER']}?message={$Message}");
			}
		}
		
		if(isset($_POST["partIdToDelete"])){
			
			$partID = $_POST["partIdToDelete"];
			
			$query = "DELETE FROM DRAMACONTENT WHERE CID = '$partID'";
			$parsed_Query = oci_parse($conn,$query);
			$success = oci_execute($parsed_Query);
			
			if($success){
				echo "Drama Part Successfully Deleted";
			}
			else {
				echo "Deletion Not-Successful";
			}
		}
		
		if(isset($_POST["dramaIdToDelete"])){
			
			$dramaID = $_POST["dramaIdToDelete"];
			
			$query = "DELETE FROM DRAMACATEGORY WHERE DRAMAID = '$dramaID'";
			$parsed_Query = oci_parse($conn,$query);
			$success1 = oci_execute($parsed_Query);
			
			$query = "DELETE FROM DRAMACONTENT WHERE DRAMA_CAT_ID = '$dramaID'";
			$parsed_Query = oci_parse($conn,$query);
			$success2 = oci_execute($parsed_Query);
			
			if($success1.$success2){
				echo "Drama Successfully Deleted";
			}
			else {
				echo "Drama Deletion Not-Successful";
			}
		}
		
		if(isset($_POST["exportInfo"])){

			$filename = date('d-m-Y').".csv"; 
			$output = fopen($filename, 'w+'); 
			
			fputcsv($output, array('DRAMANAME', 'CATEGORY', 'UPLOAD_DATE', 'ARTIST', 'DRAMA_ROYALITY'));
			
			$query = "SELECT DRAMANAME, CATEGORY, UPLOAD_DATE, ARTIST, DRAMA_ROYALITY FROM DRAMACATEGORY ORDER BY CATEGORY DESC, UPLOAD_DATE DESC";
			$parsed_Query = oci_parse($conn,$query);
			$success = oci_execute($parsed_Query);

			while ($result_Data = oci_fetch_assoc($parsed_Query)){
				fputcsv($output, $result_Data);
				echo '<br>';
			}
			
			header("Content-Type: application/csv");
			header("Content-disposition: attachment; filename={$filename}");
			// header("Pragma: no-cache");
			// header("Expires: 0");
			
			// echo $filename;
		}

		if(isset($_POST["headerFormAdding"]) && !empty($_POST["dramaName"])){
			
			foreach($_POST["dramaName"] as $dramaToAddHeading) {
				$query = "UPDATE DRAMACATEGORY SET STATUS = 1 WHERE DRAMAID = $dramaToAddHeading";
				$parsed_Query = oci_parse($conn,$query);
				$success = oci_execute($parsed_Query);
				
				if(!$success){
					$Message = "Not Updated";
					header("Location:headerSettings.php?message={$Message}");
				}
				else {
					$Message = "Success";
					header("Location:headerSettings.php?message={$Message}");
				}
			}	
		}
		
		if(isset($_POST["headerFormRemoving"]) && !empty($_POST["dramaName"])){
			
			foreach($_POST["dramaName"] as $dramaToRemove) {
				$query = "UPDATE DRAMACATEGORY SET STATUS = null WHERE DRAMAID = $dramaToRemove";
				$parsed_Query = oci_parse($conn,$query);
				$success = oci_execute($parsed_Query);
				if(!$success){
					$Message = "Not Updated";
					header("Location:headerSettings.php?message={$Message}");
				}
				else {
					$Message = "Success";
					header("Location:headerSettings.php?message={$Message}");
				}
			}	
		}
		
	?>
	
	<?php 
		oci_close($conn);
	?>