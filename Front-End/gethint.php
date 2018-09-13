

	<?php

	include("function.php");
	
	$q = trim($_REQUEST["q"]);
	$hint = "";
	
	$parsed_Query = searchName();
	
	while($result_Data = oci_fetch_assoc($parsed_Query)){
		$allNames[] = trim($result_Data['DRAMANAME']);
	}
	
	if ($q !== ""){
		$len=strlen($q);
		foreach($allNames as $name){
			if (stristr(substr($name, 0, $len), $q)){
					$hint = $name;
			}
		}
	}
	echo $hint;
	?>