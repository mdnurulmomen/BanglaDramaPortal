
	<?php
	
	include("mobileOperator.php");
	include("function.php");
	
	$searchName=trim($_GET['searchName']);
	
	$parsed_Query = searchDetailsToPlay($searchName);
	
	if($parsed_Query){
		$nrows = oci_fetch_all($parsed_Query, $result);
		oci_free_statement($parsed_Query);
		if ($nrows > 0){
			list($listVariable) = array($result);
			$DRAMAID=$listVariable['DRAMAID'];
			$CATEGORY=$listVariable['CATEGORY'];
			
			$CATEGORY[0]=base64_encode($CATEGORY[0]);
			$DRAMAID[0]=base64_encode($DRAMAID[0]);
			
			header("Location:vedioDrama.php?dramaType=$CATEGORY[0]&dramaID=$DRAMAID[0]");
		}
		else{
			$message = 'No Such File';
			// echo $searchName;
			// exit;
			echo "<SCRIPT type='text/javascript'>
			alert('$message');
			window.location.replace('index.php');
			</SCRIPT>";
		}
	}
	?>