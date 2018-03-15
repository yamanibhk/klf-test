<?php
	function __autoload($className)
	{
		$folders = array(
				RACINE . "Controler/", 
				RACINE . "Model/",
				RACINE . "View/"
			);

		foreach($folders as $fold)
		{
			$fileName = $fold . $className . ".php";
			if(file_exists($fileName))
			{
				require_once($fileName);
				return;
			}
		}
	}
	
	//declaration of the project root
	define("RACINE", $_SERVER["DOCUMENT_ROOT"] . "/klf-test/03/");

	//declaration of connection informations
	define("HOST", "localhost");
	define("DBNAME", "technical_assessment");
	define("USERNAME", "root");
	define("PWD", "");
	define("DBTYPE", "mysql");
?>