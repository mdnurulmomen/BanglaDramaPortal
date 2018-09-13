
<?php

define ('dbUserName', 'system');
define ('dbPassword', 'Oracle_1');
define ('dbInfo', '//localhost/orcl');

function headingPreviews(){
	$conn=oci_connect(dbUserName,dbPassword,dbInfo);
	
	$query = "SELECT * FROM(SELECT DRAMAID, CATEGORY, DRAMA_PREVIEW FROM DRAMACATEGORY WHERE STATUS = 1 ORDER BY UPLOAD_DATE DESC)WHERE ROWNUM<=8";
	$parsed_Query = oci_parse($conn,$query);
	$success = oci_execute($parsed_Query);
	
	oci_close($conn);
	return $parsed_Query;
}
 
function singleDrama(){
	$conn=oci_connect(dbUserName,dbPassword,dbInfo);

	$query = "SELECT * FROM(SELECT DISTINCT DRAMACONTENT.DRAMA_CAT_ID, DRAMACATEGORY.DRAMA_PREVIEW FROM DRAMACONTENT 
	INNER JOIN DRAMACATEGORY ON (DRAMACATEGORY.DRAMAID=DRAMACONTENT.DRAMA_CAT_ID) 
	WHERE DRAMACONTENT.CATEGORY = 'Single' AND DRAMACONTENT.STATUS=1 ORDER BY DRAMA_CAT_ID DESC)WHERE ROWNUM<=8";
	$parsed_Query = oci_parse($conn,$query);
	$success = oci_execute($parsed_Query);
	
	oci_close($conn);
	
	return $parsed_Query;
}

function serialDrama(){
	$conn=oci_connect(dbUserName,dbPassword,dbInfo);
			
	$query = "SELECT * FROM(SELECT DISTINCT DRAMACONTENT.DRAMA_CAT_ID, DRAMACATEGORY.DRAMA_PREVIEW FROM DRAMACONTENT 
	INNER JOIN DRAMACATEGORY ON (DRAMACATEGORY.DRAMAID=DRAMACONTENT.DRAMA_CAT_ID) 
	WHERE DRAMACONTENT.CATEGORY = 'Serial' AND DRAMACONTENT.STATUS=1 ORDER BY DRAMA_CAT_ID DESC)WHERE ROWNUM<=8";
	$parsed_Query = oci_parse($conn,$query);
	$success = oci_execute($parsed_Query);
	
	oci_close($conn);
	
	return $parsed_Query;
}
 
function artistChoice(){
	$conn=oci_connect(dbUserName,dbPassword,dbInfo);
		
	$query = "SELECT * FROM (SELECT DISTINCT DRAMACONTENT.DRAMA_CAT_ID, DRAMACATEGORY.ARTIST_PREVIEW FROM DRAMACONTENT 
	INNER JOIN DRAMACATEGORY ON (DRAMACATEGORY.DRAMAID=DRAMACONTENT.DRAMA_CAT_ID)
	WHERE DRAMACONTENT.CATEGORY = 'Artist' AND DRAMACONTENT.STATUS=1 ORDER BY DRAMA_CAT_ID DESC)WHERE ROWNUM<=8";
	$parsed_Query = oci_parse($conn,$query);
	$success = oci_execute($parsed_Query);
	
	oci_close($conn);
	
	return $parsed_Query;
}

function featuredDrama(){
	$conn=oci_connect(dbUserName,dbPassword,dbInfo);
						
	$query = "SELECT * FROM (SELECT DISTINCT DRAMACONTENT.DRAMA_CAT_ID, DRAMACATEGORY.DRAMA_PREVIEW FROM DRAMACONTENT 
	INNER JOIN DRAMACATEGORY ON (DRAMACATEGORY.DRAMAID=DRAMACONTENT.DRAMA_CAT_ID)  
	WHERE DRAMACONTENT.CATEGORY = 'Featured' AND DRAMACONTENT.STATUS=1 ORDER BY DRAMA_CAT_ID DESC)WHERE ROWNUM<=4";
	$parsed_Query = oci_parse($conn,$query);
	$success = oci_execute($parsed_Query);
	
	oci_close($conn);
	
	return $parsed_Query;
}

function recentDrama(){
	$conn=oci_connect(dbUserName,dbPassword,dbInfo);
						
	$query = "SELECT * FROM(SELECT CID, DRAMA_CAT_ID, DRAMA_PREVIEW FROM DRAMACONTENT WHERE 
	CATEGORY NOT IN ('Featured','Artist') AND STATUS=1 ORDER BY UPLOAD_DATE DESC)WHERE ROWNUM<=4";
	$parsed_Query = oci_parse($conn,$query);
	$success = oci_execute($parsed_Query);

	oci_close($conn);
	
	return $parsed_Query;
}

function mostViewedDrama(){
	$conn=oci_connect(dbUserName,dbPassword,dbInfo);
						
	$query = "SELECT * FROM(SELECT CID, DRAMA_PREVIEW 
	FROM DRAMACONTENT WHERE STATUS=1 ORDER BY TOTAL_VIEWS DESC)WHERE ROWNUM<=4";
	$parsed_Query = oci_parse($conn,$query);
	$success = oci_execute($parsed_Query);

	oci_close($conn);
	
	return $parsed_Query;
}
 
function more($selectedDramaType){			
	$conn=oci_connect(dbUserName,dbPassword,dbInfo);
	
	$query = "SELECT DISTINCT DRAMACONTENT.DRAMA_CAT_ID, DRAMACATEGORY.DRAMA_PREVIEW FROM DRAMACONTENT 
	INNER JOIN DRAMACATEGORY ON (DRAMACATEGORY.DRAMAID=DRAMACONTENT.DRAMA_CAT_ID) 
	WHERE DRAMACONTENT.CATEGORY = '$selectedDramaType' AND DRAMACONTENT.STATUS=1";
	
	$parsed_Query = oci_parse($conn,$query);
	$success = oci_execute($parsed_Query);
	
	oci_close($conn);
	
	return $parsed_Query;
}

function vedioDramaAllParts($selectedDramaID){
	
	$conn=oci_connect(dbUserName,dbPassword,dbInfo);
				
	$query = "SELECT * FROM DRAMACONTENT WHERE DRAMA_CAT_ID = $selectedDramaID AND STATUS = 1 ORDER BY CID ASC";
	$parsed_Query = oci_parse($conn,$query);
	$success = oci_execute($parsed_Query);
	
	oci_close($conn);
				
	return $parsed_Query;
}


function vedioDramaOtherDrama($selectedDramaType, $selectedDramaID){
	
	$conn=oci_connect(dbUserName,dbPassword,dbInfo);
			
	$query = "SELECT * FROM (SELECT DISTINCT DRAMACONTENT.DRAMA_CAT_ID, DRAMACATEGORY.DRAMA_PREVIEW FROM DRAMACONTENT 
INNER JOIN DRAMACATEGORY ON (DRAMACATEGORY.DRAMAID=DRAMACONTENT.DRAMA_CAT_ID) WHERE DRAMACONTENT.CATEGORY = '$selectedDramaType' AND DRAMACONTENT.STATUS = 1 
MINUS SELECT DISTINCT DRAMACONTENT.DRAMA_CAT_ID, DRAMACATEGORY.DRAMA_PREVIEW FROM DRAMACONTENT 
INNER JOIN DRAMACATEGORY ON (DRAMACATEGORY.DRAMAID=DRAMACONTENT.DRAMA_CAT_ID) 
WHERE DRAMACONTENT.DRAMA_CAT_ID = $selectedDramaID ORDER BY DRAMA_CAT_ID DESC)WHERE ROWNUM<=8";
	
	$parsed_Query = oci_parse($conn,$query);
	$success = oci_execute($parsed_Query);
	
	oci_close($conn);
	
	return $parsed_Query;
}

function categoryCheck(){
	$conn=oci_connect(dbUserName,dbPassword,dbInfo);
	
	$query = "SELECT DISTINCT CATEGORY FROM DRAMACONTENT WHERE STATUS = 1";
	$parsed_Query = oci_parse($conn,$query);
	$success = oci_execute($parsed_Query);
	
	oci_close($conn);
	
	return $parsed_Query;
}

function countViews($dramaPartId){
	$conn=oci_connect(dbUserName,dbPassword,dbInfo);
	
	$queryUpdate = "UPDATE DRAMACONTENT SET TOTAL_VIEWS = TOTAL_VIEWS + 1 WHERE CID = $dramaPartId";
	$parsed_Query = oci_parse($conn,$queryUpdate);
	$successUpdate = oci_execute($parsed_Query);
	
	oci_close($conn);
	
	return $parsed_Query;
}

function artistChoiceDramaAllPart($selectedDramaID){
	$conn=oci_connect(dbUserName,dbPassword,dbInfo);
	
	$query = "SELECT * FROM DRAMACONTENT WHERE DRAMA_CAT_ID = $selectedDramaID AND STATUS = 1 ORDER BY CID ASC";
	$parsed_Query = oci_parse($conn,$query);
	$success = oci_execute($parsed_Query);
	
	oci_close($conn);
	
	return $parsed_Query;
}

function artistChoiceOtherDrama($selectedDramaType, $selectedDramaID){
	$conn=oci_connect(dbUserName,dbPassword,dbInfo);
			
	$query = "SELECT * FROM (SELECT DISTINCT DRAMACONTENT.DRAMA_CAT_ID, DRAMACATEGORY.ARTIST_PREVIEW FROM DRAMACONTENT 
INNER JOIN DRAMACATEGORY ON (DRAMACATEGORY.DRAMAID=DRAMACONTENT.DRAMA_CAT_ID) WHERE DRAMACONTENT.CATEGORY = '$selectedDramaType' AND DRAMACONTENT.STATUS = 1
MINUS SELECT DISTINCT DRAMACONTENT.DRAMA_CAT_ID, DRAMACATEGORY.ARTIST_PREVIEW FROM DRAMACONTENT 
INNER JOIN DRAMACATEGORY ON (DRAMACATEGORY.DRAMAID=DRAMACONTENT.DRAMA_CAT_ID)
WHERE DRAMACONTENT.DRAMA_CAT_ID = $selectedDramaID ORDER BY DRAMA_CAT_ID DESC)WHERE ROWNUM<=12";

	$parsed_Query = oci_parse($conn,$query);
	$success = oci_execute($parsed_Query);
	
	oci_close($conn);
	
	return $parsed_Query;
}

function mostViewedDramaAllParts(){
	
	$conn=oci_connect(dbUserName,dbPassword,dbInfo);
			
	$query = "SELECT * FROM (SELECT CID, DRAMANAME, DRAMA_PREVIEW, DRAMA_FILEPATH FROM DRAMACONTENT WHERE STATUS=1 ORDER BY TOTAL_VIEWS DESC)WHERE ROWNUM<=8";
	$parsed_Query = oci_parse($conn,$query);
	$success = oci_execute($parsed_Query);
	
	oci_close($conn);
	
	return $parsed_Query;
}

function recentDramaAllParts($selectedDramaID){
	
	$conn=oci_connect(dbUserName,dbPassword,dbInfo);
	
	$query = "SELECT * FROM DRAMACONTENT WHERE DRAMA_CAT_ID = $selectedDramaID AND STATUS = 1 ORDER BY CID ASC";
	$parsed_Query = oci_parse($conn,$query);
	$success = oci_execute($parsed_Query);
	
	oci_close($conn);
	
	return $parsed_Query;
}

function recentOtherDrama(){
	
	$conn=oci_connect(dbUserName,dbPassword,dbInfo);
		
	$query = "SELECT * FROM(SELECT CID, DRAMA_CAT_ID, DRAMA_PREVIEW FROM DRAMACONTENT WHERE CATEGORY 
	NOT IN ('Featured') AND DRAMACONTENT.STATUS=1 ORDER BY UPLOAD_DATE DESC)WHERE ROWNUM<=8";
	$parsed_Query = oci_parse($conn,$query);
	$success = oci_execute($parsed_Query);
	
	oci_close($conn);
	
	return $parsed_Query;
}

function searchDetailsToPlay($searchName){
	$conn=oci_connect(dbUserName,dbPassword,dbInfo);
	
	$query = "SELECT DRAMAID, CATEGORY FROM DRAMACATEGORY WHERE DRAMANAME LIKE '$searchName'";
	$parsed_Query = oci_parse($conn,$query);
	$success = oci_execute($parsed_Query);
	
	oci_close($conn);
	
	return $parsed_Query;
}

function searchName(){
	$conn=oci_connect(dbUserName,dbPassword,dbInfo);
	
	$query = "SELECT DRAMANAME FROM DRAMACATEGORY";
	$parsed_Query = oci_parse($conn,$query);
	$success = oci_execute($parsed_Query);
	
	oci_close($conn);
	
	return $parsed_Query;
}
?>