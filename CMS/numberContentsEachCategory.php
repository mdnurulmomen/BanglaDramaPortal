<?php
	error_reporting(0);
	$conn=oci_connect("system","Oracle_1","//localhost/orcl");
	if($conn){
		$query = "SELECT CATEGORY, COUNT(DRAMAID) AS CONTENTS_NUM FROM DRAMACATEGORY GROUP BY CATEGORY";
		$parsed_Query = oci_parse($conn, $query);
		$success = oci_execute($parsed_Query);
		
		if($success){
			$nrows = oci_fetch_all($parsed_Query, $result);
			oci_free_statement($parsed_Query);
			
			if ($nrows > 0) {
				list($result) = array($result);
				$category=$result['CATEGORY'];
				$count=$result['CONTENTS_NUM'];
			}
			else{
				echo 'Result is Empty';
			}
		}
		else{
			return false;
		}
		oci_close($conn);	
	}
	else {
		echo 'DB Not Connected';
	}	
?>

<div class="social grid text-center">
	<details>
		<summary class="asPointLine">
			Contents in Each Category
		</summary>
		<div class="col-md-3 col-sm-3 text-center">	
			<h3> <?php echo $category[0]; ?> : <?php echo $count[0]; ?></h3>			
		</div>
			
		<div class="col-md-3 col-sm-3 text-center">	
			<h3> <?php echo $category[1]; ?> : <?php echo $count[1]; ?></h3>			
		</div>
		
		<div class="col-md-3 col-sm-3 text-center">	
			<h3> <?php echo $category[2]; ?> : <?php echo $count[2]; ?></h3>			
		</div>
		
		<div class="col-md-3 col-sm-3 text-center">	
			<h3> <?php echo $category[3]; ?> : <?php echo $count[3]; ?></h3>			
		</div>
		
		<div class="clearfix"> </div>
	</details>
</div>