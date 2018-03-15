<?php
	class User
	{
      public $user_id;
      public $ts_inserted;
      public $user_inserted;
      public $dt_modified;
      public $user_modified;
      public $first_name;
      public $last_name;
      public $job_title;
      public $email;
      public $address_1;
      public $address_2;
      public $city;
      public $postal_code;
      public $province;
      public $country;
      public $phone;
      public $password;
      public $salt;
      public $date_of_birth;
      public $disable;
      public $reset_password;
      public $role_id;

      public function __construct($userId = 0, $ts = "", $userIns = "", $dt = "", $userMod = "", $firstName = "", $lastName = "", $jobTitle = "", $email = "", $add1 = "", $add2 = "", $city = "", $postCod = "", $prov = "", $countr = "", $phone = "", $pass = "", $salt = "", $db = "", $dis = "", $resPass = "", $roleId = "")
      {
        $this->user_id = $userId;
        $this->ts_inserted = $ts;
        $this->user_inserted = $userIns;
        $this->dt_modified = $dt;
        $this->user_modified = $userMod;
        $this->first_name = $firstName;
        $this->last_name = $lastName;
        $this->job_title = $jobTitle;
        $this->email = $email;
        $this->address_1 = $add1;
        $this->address_2 = $add2;
        $this->city = $city;
        $this->postal_code = $postCod;
        $this->province = $prov;
        $this->country = $countr;
        $this->phone = $phone;
        $this->password = $pass;
        $this->salt = $salt;
        $this->date_of_birth = $db;
        $this->disable = $dis;
        $this->reset_password = $resPass;
        $this->role_id = $roleId;
      }
	}

?>