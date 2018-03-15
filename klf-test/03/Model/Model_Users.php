<?php
	class Model_Users extends BaseDAO
	{
		public function getTableName()
		{
			return "users";
		}
		
				
		public function getting_all()
		{
			
			$results = $this->readAll();
			$users = $results->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "User");
			return $users;
		}

		public function save(User $theUser)
		{
			if($theUser->user_id && $this->read($theUser->user_id)->fetch())
			{
				//update
                
              $query = "UPDATE " . $this->getTableName() . " SET ts_inserted=?, user_inserted=?, dt_modified=?, user_modified=?, first_name=?, last_name=?, job_title=?, email=?, address_1=?, address_2=?, city=?, postal_code=?, province=?, country=?, phone=?, password=?, salt=?, date_of_birth=?, disable=?, reset_password=?, role_id=? WHERE user_id=?";
				$datas = array($theUser->ts_inserted,$theUser->user_inserted,$theUser->dt_modified,$theUser->user_modified,$theUser->first_name,$theUser->last_name,$theUser->job_title,$theUser->email,$theUser->address_1,$theUser->address_2,$theUser->city,$theUser->postal_code,$theUser->province,$theUser->country,$theUser->phone,$theUser->password,$theUser->salt,$theUser->date_of_birth,$theUser->disable,$theUser->reset_password,$theUser->role_id,$theUser->user_id);
				return $this->request($query, $datas);
			}
			else
			{
				//insert
      
              
				$query = "INSERT INTO " . $this->getTableName() . "(ts_inserted, user_inserted, dt_modified, user_modified, first_name, last_name, job_title, email, address_1, address_2, city, postal_code, province, country, phone, password, salt, date_of_birth, disable, reset_password, role_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
				$datas = array($theUser->ts_inserted,$theUser->user_inserted,$theUser->dt_modified,$theUser->user_modified,$theUser->first_name,$theUser->last_name,$theUser->job_title,$theUser->email,$theUser->address_1,$theUser->address_2,$theUser->city,$theUser->postal_code,$theUser->province,$theUser->country,$theUser->phone,$theUser->password,$theUser->salt,$theUser->date_of_birth,$theUser->disable,$theUser->reset_password,$theUser->role_id);
				return $this->request($query, $datas);
			}
		}
		
		
		////////////////////////////////////////////////deleting user/////////////////////////////////////////////////////
		public function delette($id)
		{
			if($this->read($id)->fetch())
			{			
				$this->delet($id);
			
				
			}
		}
		
		
	}
?>