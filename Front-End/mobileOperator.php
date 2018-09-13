<?php
	function getMobileNumber() {
		if(isset($_SERVER['USER_IDENTITY_FORWARD_MSISDN']))
		{
			$mobile_number = trim($_SERVER['HTTP_X_UP_CALLING_LINE_ID']);
		}
		else if(isset($_SERVER['HTTP_MSISDN']))
		{
			$mobile_number = trim($_SERVER['HTTP_MSISDN']);
		}
		else if(isset($_SERVER['HTTP_X_FH_MSISDN']))
		{
			$mobile_number = trim($_SERVER['HTTP_X_FH_MSISDN']);
		}
		else if(isset($_SERVER['HTTP_X_HTS_CLID']))
		{
			$mobile_number = trim($_SERVER['HTTP_X_HTS_CLID']);
		}
		else if(isset($_SERVER['HTTP_X_UP_CALLING_LINE_ID']))
		{
			$mobile_number = trim($_SERVER['HTTP_X_UP_CALLING_LINE_ID']);
		}
		else if(isset($_SERVER['HTTP-ALL-RAW']))
		{
			$mobile_number = trim($_SERVER['HTTP-ALL-RAW']);
		}
		 else if(isset($_SERVER['HTTP-HOST']))
		{
			$mobile_number = trim($_SERVER['HTTP-HOST']);
		}
		else if(isset($_SERVER['x-msisdn']))
		{
			$mobile_number = trim($_SERVER['x-msisdn']);
		}
		else if(isset($_SERVER['HTTP-x-msisdn']))
		{
			$mobile_number = trim($_SERVER['HTTP-x-msisdn']);
		}
		else if(isset($_SERVER['x-h3g-msisdn']))
		{
			$mobile_number = trim($_SERVER['x-h3g-msisdn']);
		}
		else if(isset($_SERVER['HTTP-x-h3g-msisdn']))
		{
			$mobile_number = trim($_SERVER['HTTP-x-h3g-msisdn']);
		}
		else if(isset($_SERVER['HTTP-X-MSISDN-Alias']))
		{
			$mobile_number = trim($_SERVER['HTTP-X-MSISDN-Alias']);
		}
		else if(isset($_SERVER['X-MSISDN-Alias']))
		{
			$mobile_number = trim($_SERVER['X-MSISDN-Alias']);
		}
		else if(isset($_SERVER['HTTP-x-h3g-msisdn']))
		{  
			$mobile_number = trim($_SERVER['HTTP-x-h3g-msisdn']);
		}
		else if(isset($_SERVER['HTTP-msisdn']))
		{
			$mobile_number = trim($_SERVER['HTTP-msisdn']);
		}
		else if(isset($_SERVER['msisdn']))
		{
			$mobile_number = trim($_SERVER['msisdn']);
		}
		else if(isset($_SERVER['MSISDN']))
		{
			$mobile_number = trim($_SERVER['MSISDN']);
		}
		else if(isset($_SERVER['X-WAP-PROFILE']))
		{
			$mobile_number = trim($_SERVER['X-WAP-PROFILE']);
		}
		else if(isset($_SERVER['X-UP-CALLING-LINE-ID ']))
		{
			$mobile_number = trim($_SERVER['X-UP-CALLING-LINE-ID ']);
		}
		else if(isset($_SERVER['X-H3G-MSISDN']))
		{
			$mobile_number = trim($_SERVER['X-H3G-MSISDN']);
		}
		else if(isset($_SERVER['X-FH-MSISDN ']))
		{
			$mobile_number = trim($_SERVER['X-FH-MSISDN ']);
		}
		else if(isset($_SERVER['X-MSP-MSISDN']))
		{
			$mobile_number = trim($_SERVER['X-MSP-MSISDN']);
		}
		else if(isset($_SERVER['X-INTERNET-MSISDN']))
		{
			$mobile_number = trim($_SERVER['X-INTERNET-MSISDN']);
		}
		else if(isset($_SERVER['X_MSISDN']))
		{
			$mobile_number = trim($_SERVER['X_MSISDN']);
		}
		else if(isset($_SERVER['HTTP_X_MSISDN']))
		{
			$mobile_number = trim($_SERVER['HTTP_X_MSISDN']);
		}
		else{
			$mobile_number = '8801612989900';
			// return null;
		}
		return $mobile_number;
	}
	
	function defineOperator($mobile_number){
		
		if (isset($mobile_number)){
			
			$mobile_number = ltrim($mobile_number,"88");
			$operator = '';
			
			if(strncmp($mobile_number,"019",3) == 0)
			{
				$operator = 'Banglalink';
			} 
			else if(strncmp($mobile_number,"017",3) == 0)
			{
				$operator = 'GrameenPhone';
			} 
			else if(strncmp($mobile_number,"018",3) == 0)
			{
				$operator = 'Robi';
			} 
			else if(strncmp($mobile_number,"016",3) == 0)
			{
				$operator = 'airtel';
			}
			else{
				unset($operator);
				return null;
			}
			
			return $operator;
		}
		else{
			return null;
		}
	}

	function url_log_banglaDrama($url){
		$logFileWAP = "logfiles/url-log-" . date("m.d.Y") . ".txt";
		$time = date("d-m-Y H:i:s");
		$pageName = basename($_SERVER['PHP_SELF']);
		$ua = $_SERVER['HTTP_USER_AGENT'];
		$ip = $_SERVER['REMOTE_ADDR'];
		$apn = "WAP";
		$filew = fopen($logFileWAP, (file_exists($logFileWAP)) ? 'a' : 'w');
		fwrite($filew, "$time | $url | $pageName | $ua | $ip\r\n");
	}
?>

<?php
	$mobile_number = getMobileNumber();
	$operator = defineOperator($mobile_number);

	if(isset($operator))
		url_log_banglaDrama($mobile_number);
	else
		url_log_banglaDrama('PC or Other Operator');
?>	