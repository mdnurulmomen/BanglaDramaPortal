<?php
$parsed_Query = categoryCheck();

if($parsed_Query){
	$nrows = oci_fetch_all($parsed_Query, $result);
	oci_free_statement($parsed_Query);
	if ($nrows > 0) {
		list($listVariable) = array($result);
		$categories=$listVariable['CATEGORY'];
	}
	else{
		$categories=array();
	}
}
?>