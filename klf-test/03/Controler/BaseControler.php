<?php
	abstract class BaseControler
	{		
		//this method will be called from the router
		public abstract function traite(array $params);
        
        
      
		protected function showView($viewName, $data = null)
		{
			$viewPath = RACINE . "View/" . $viewName . ".php";

			if(file_exists($viewPath))
			{
				include($viewPath);
			}
			else
			{
				trigger_error("Error 404! the view $viewPath doesn't exist!");
			}
		}

		protected function getDAO($modelName)
		{
			$class = "Model_" . $modelName;

			if(class_exists($class))
			{
				//connection to database
				$theDB = DBFactory::getDB(DBTYPE, DBNAME, HOST, USERNAME, PWD);

				//creation of an instance of the class Model_$class
				
				$objetModel = new $class($theDB);
				if($objetModel instanceof BaseDAO)
				{
					return $objetModel;
				}
				else
				{
					trigger_error("The model does not conform.");
				}
			}
		}

	}
?>