<?php
	class Router
	{
		public static function route()
		{
			//get the controller who will execute the request.
			$queryString = $_SERVER["QUERY_STRING"];
			$posEperluette = strpos($queryString, "&");

			if($posEperluette === FALSE)
				$controler = $queryString;
			else
				$controler = substr($queryString, 0, $posEperluette);

			//if no controler specified put a default controler
			if($controler == "")
				$controler = "Users";
			//shearching for the class with the controler name
			$class = "Controler_" . $controler;

			if(class_exists($class))
			{
				//controler declaration
				$objetcontroler = new $class;
				if($objetcontroler instanceof Basecontroler)
					$objetcontroler->traite($_REQUEST);
				else
					trigger_error("invalid controler.");
			}
			else
			{
				trigger_error("Error 404! the view $class doesn't exist!");
			}
		}
	}
?>