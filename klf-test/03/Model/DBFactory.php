<?php

	class DBFactory
	{
		public static function getDB($typeBD, $dbName, $host, $user, $pwd)
		{
			if($typeBD == "mysql")
			{
				$theDB = new PDO("mysql:host=$host;dbname=$dbName", $user, $pwd);
			}
			else if($typeBD == "oracle")
			{
				$theDB = new PDO("oci:host=$host;dbname=$dbName", $user, $pwd);		
			}
			else
				trigger_error("The specified DB type is not supported.");
			//else if...
			
			$theDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$theDB->exec("SET NAMES 'utf8'");
			return $theDB;			
		}
	}		
?>

