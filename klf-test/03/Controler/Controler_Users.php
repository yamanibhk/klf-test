<?php
  class Controler_Users extends BaseControler
  {		
    public function traite(array $params)
    {
      $errors="";
      if(isset($params["action"]))
      { 
        
        switch($params["action"])
        {
          ///////////////////////////////////////////////show list of users//////////////////////////////////////
          case "showUsers":
              $this->showUsersList($errors);
              break;
          
          ///////////////////////////////////////////////deleting a user/////////////////////////////////////////	
          case "deleteUser":

              if(isset($params["userId"]) && Trim($params["userId"])<>"" && is_numeric(trim($params["userId"])))
              {
                      $modelUsers = $this->getDAO("Users");
                      $modelUsers->delette($params["userId"]);
                      $this->showUsersList($errors);
              }
              else
              {
                  echo "<br/>id not valid!";
              }


              break;	
          ///////////////////////////////////////////////insertion of user/////////////////////////////////////	
          case "insertUser" :
                
              if(isset($params["ts"]) && isset($params["userIns"]) && isset($params["dt"])
                && isset($params["userMod"]) && isset($params["firstName"])&& isset($params["lastName"]) && isset($params["jobTitle"])
                && isset($params["email"]) && isset($params["add1"])&& isset($params["add2"]) && isset($params["city"])
                && isset($params["postCod"]) && isset($params["prov"])&& isset($params["countr"]) && isset($params["phone"])
                && isset($params["pass"]) && isset($params["salt"])&& isset($params["db"]) && isset($params["dis"])
                && isset($params["resPass"]) && isset($params["roleId"]))
              { 
                  $errors = $this->controlDataForm($params["firstName"], $params["lastName"], $params["jobTitle"], $params["email"], $params["add1"],$params["city"], $params["postCod"], $params["prov"], $params["countr"], $params["phone"], $params["pass"],$params["db"]);
               
                  //if no error
                  if($errors == "")
                  {
                      $modelUsers = $this->getDAO("Users");
                      if (isset($params["userId"])) $iduser=$params["userId"] ;else $iduser=0;
                      $newUser = new User($iduser, $params["ts"], $params["userIns"], $params["dt"], $params["userMod"], $params["firstName"], $params["lastName"], $params["jobTitle"], $params["email"], $params["add1"], $params["add2"], $params["city"], $params["postCod"], $params["prov"], $params["countr"], $params["phone"], $params["pass"], $params["salt"], $params["db"], $params["dis"], $params["resPass"], $params["roleId"]);
                    
                      $succes = $modelUsers->save($newUser);
                      if($succes)
                      {
                          $this->showUsersList($errors);
                      }
                      else
                      {
                          $this->showUsersList($errors);
                      }
                  }
                  else
                  {
                      $this->showUsersList($errors);
                  }
              }
              else
              {
                  $this->showUsersList($errors);
              }
              break;	
          default:
              trigger_error("Invalid action.");		
        }


      }
      else
      {
          //default action in case no action specified
          $this->showUsersList($errors);
      }
    }
	  private function base_url()
        {
          if(isset($_SERVER['HTTPS'])){
              $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
          }
          else{
              $protocol = 'http';
          }
          return $protocol . "://" . $_SERVER['HTTP_HOST'];
        }

      private function showUsersList($errors)
      {
		  $vat=$this->base_url();
          $data["vat"]=$vat;
          $modelUsers = $this->getDAO("Users");
          $data["users"] = $modelUsers->getting_all();
          $data["errors"] = $errors;
          $this->showView("ListUsers", $data);
		  
      }

    

      private function controlDataForm($firstName, $lastName, $jobTitle, $email, $add1, $city, $postCod, $prov, $countr, $phone, $pass, $db)
      {
          $errors = "";
          $firstName = trim($firstName);
          $lastName = trim($lastName);
          $jobTitle = trim($jobTitle);
          $email = trim($email);
          $add1 = trim($add1);
          $city = trim($city);
          $postCod = trim($postCod);
          $prov = trim($prov);
          $countr = trim($countr);
          $phone = trim($phone);
          $pass = trim($pass);
          $db = trim($db);
                    
          if($firstName == "")
              $errors .= "the first name can't be empty.<br>";
          else if(strlen($firstName) > 256)
                $errors .= "the first name is too long.";
                else if (!preg_match("/^(?=.{2,256}$)[a-zàâäéèêëìîïòôöùûüÿ]+(?:[-' ][a-zàâäéèêëìîïòôöùûüÿ]+)*$/i", $firstName)) 
                      $errors .= "the first name contains not allowed caracters.";
          
        if($lastName == "")
              $errors .= "the last name can't be empty.<br>";
          else if(strlen($lastName) > 256)
                $errors .= "the last name is too long.";
                else if (!preg_match("/^(?=.{2,256}$)[a-zàâäéèêëìîïòôöùûüÿ]+(?:[-' ][a-zàâäéèêëìîïòôöùûüÿ]+)*$/i", $lastName)) 
                      $errors .= "the last name contains not allowed caracters.";
        
          if($jobTitle == "")
              $errors .= "the job title can't be empty.<br>";
          else if(strlen($jobTitle) > 100)
                $errors .= "the job title is too long.";
                else if (!preg_match("/^(?=.{2,100}$)[a-zàâäéèêëìîïòôöùûüÿ\d]+(?:[-' ][a-zàâäéèêëìîïòôöùûüÿ\d]+)*$/i", $jobTitle)) 
                      $errors .= "the job title contains not allowed caracters.";
        
          if($email == "")
              $errors .= "the email can't be empty.<br>";
          else if(strlen($email) > 256)
                $errors .= "the email is too long.";
                else if (!preg_match("/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/i", $email)) 
                      $errors .= "the email contains not allowed caracters.";
        
          if($add1 == "")
              $errors .= "the address can't be empty.<br>";
          else if(strlen($add1) > 256)
                $errors .= "the address is too long.";
                else if (!preg_match("/^(?=.{10,256}$)[a-zàâäéèêëìîïòôöùûüÿ\d]+(?:[-' ][a-zàâäéèêëìîïòôöùûüÿ\d]+)*$/i", $add1)) 
                      $errors .= "the address contains not allowed caracters.";
        
          if($city == "")
              $errors .= "the city can't be empty.<br>";
          else if(strlen($city) > 256)
                $errors .= "the city is too long.";
                else if (!preg_match("/^(?=.{4,256}$)[a-zàâäéèêëìîïòôöùûüÿ\d]+(?:[-' ][a-zàâäéèêëìîïòôöùûüÿ\d]+)*$/i", $city)) 
                      $errors .= "the city contains not allowed caracters.";
        
          if($postCod == "")
              $errors .= "the postal code can't be empty.<br>";
          else if(strlen($postCod) > 45)
                $errors .= "the postal code is too long.";
                else if (!preg_match("/^(?=.{4,45}$)[a-z\d]+(?:[- ][a-z\d]+)*$/i", $postCod)) 
                      $errors .= "the postal code contains not allowed caracters.";
        
          if($prov == "")
              $errors .= "the province can't be empty.<br>";
          else if(strlen($prov) > 45)
                $errors .= "the province is too long.";
                else if (!preg_match("/^(?=.{2,45}$)[a-zàâäéèêëìîïòôöùûüÿ]+(?:[-' ][a-zàâäéèêëìîïòôöùûüÿ]+)*$/i", $prov)) 
                      $errors .= "the province contains not allowed caracters.";
        
          if($countr == "")
              $errors .= "the country can't be empty.<br>";
          else if(strlen($countr) > 45)
                $errors .= "the country is too long.";
                else if (!preg_match("/^(?=.{4,45}$)[a-zàâäéèêëìîïòôöùûüÿ]+(?:[-' ][a-zàâäéèêëìîïòôöùûüÿ]+)*$/i", $countr)) 
                      $errors .= "the country contains not allowed caracters.";
        
          if($phone == "")
              $errors .= "the phone number can't be empty.<br>";
          else if(strlen($phone) > 45)
                $errors .= "the phone number is too long.";
                else if (!preg_match("/^([0-9]{2,3}(\s|-)?)*$/i", $phone)) 
                      $errors .= "the phone number contains not allowed caracters.";
        
          if($pass == "")
              $errors .= "the password can't be empty.<br>";
          else if (strlen($pass) > 512)
                $errors .= "the password is too long.";
        
          if($db == "")
              $errors .= "the birth date can't be empty.<br>";
          else if(strlen($db) > 10)
                $errors .= "the birth date is too long.";
                
          
          return $errors;
      }
  }
?>