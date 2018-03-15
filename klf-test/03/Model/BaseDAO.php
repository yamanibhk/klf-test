<?php
	abstract class BaseDao
	{
		protected $db;

		public function __construct(PDO $dbPDO)
		{			
			$this->db = $dbPDO;
		}
			

		/**
		 * Delete a row from a table
		 * @param      <STRING>  $primaryKey     The primary key
		 * @return     <BOOLEAN>  boolean answer for the delete status:true for success and false for failure
		 */
		protected function delet($primaryKey)
		{
			$query = "DELETE FROM " . $this->getTableName() . " WHERE " . $this->getPrimaryKey() ."=?";
			$data = array($primaryKey);
			return $this->request($query, $data);
		}
        
        /**
		 * reads the content from a table
		 *
		 * @param      VAR             $valeurCherchee  The cle primaire from the
		 *                                              table you'll want to read
		 * @param      boolean|string  $clePrimaire   The other column
		 *
		 * @return     <type>          ( description_of_the_return_value )
		 */
		protected function read($valSearched, $primaryKey = NULL)
		{
			if(!isset($primaryKey)){
				$query = "SELECT * from " . $this->getTableName() . " WHERE " . $this->getPrimaryKey() ."=?";
			}
			else{
				$query = "SELECT * from " . $this->getTableName() . " WHERE " . $primaryKey ."=?";
			}
			$data = array($valSearched);
			return $this->request($query, $data);
		}
		/**
		 *  read all the rows from a table 
		 * @return     <OBJECT>  all data found in the table
		 */
		protected function readAll()
		{
			$query = "SELECT * from " . $this->getTableName();
			
			return $this->request($query);
		}
		

		/**
		 * Makes a query to a table with the parameters you'll send
		 * @param      STRING  $query  The query
		 * @param      array   $data   The values to insert into the query
		 * @return     <type>  ( description_of_the_return_value )
		 */
		final protected function request($query, $data = array())
		{
			try
			{
				$stmt = $this->db->prepare($query);
				$stmt->execute($data);
			}
			catch(PDOException $e)
			{
				trigger_error("<p>The following query gave an error : $query</p><p>Exception : " . $e->getMessage() . "</p>");
			}
			return $stmt;
		}
		
		final protected function getPrimaryKey()
		{
			
			$query = "Show columns FROM " . $this->getTableName();
			$result = $this->request($query);
			foreach ($result as $row)
			{
				if($row["Key"]=="PRI")
				{
					return $row["Field"];
				}
			}
		}

		/**
		 * Gets the table name.
		 */
		abstract function getTableName();	
	}
?>