<?php

class InputValidator
{

    public function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      public function zip_code_tester($input)
      {
          $result = "";
          $input = $this->test_input($input);
          if (strlen($input) < 5)
	        {
		        return "Zipcode can not be below 5 charcters!";
	        }

	        if (strlen($input) > 9)
	        {
	        	return "Zipcode can not exceed 9 charcters!";
	        }
            return $result;
      }

      public function city_tester($input)
      {
          $result = "";
          $input = $this->test_input($input);
          if (strlen($input) > 100)
          {
              $result = "City can not exceed 100 charcters!";
          }
            return $result;
      }

      public function address_2_tester($input)
      {
          $result = "";
          $input = $this->test_input($input);
          if (strlen($input) > 100)
          {
              $result = "Address 2 can not exceed 100 charcters!";
          }
            return $result;
      }

      public function address_1_tester($input)
      {
          $result = "";
          $input = $this->test_input($input);
          if (strlen($input) > 100)
          {
              $result = "Address 1 can not exceed 100 charcters!";
          }
            return $result;
      }


      public function name_tester($input)
      {
          $result = "";
          $input = $this->test_input($input);
          if (!preg_match("/^[a-zA-Z-' ]*$/",$input)) {
            $result = "Only letters and white space allowed";
          }
          if (strlen($input) > 50)
          {
              $result = "Full name can not exceed 50 charcters!";
          }
            return $result;
      }

      public function login_credentials_checker($username, $password)
      {
        return "dgd";
      }

      public function getUserAddress($user_id_input) 
      {
        $db = new SQLite3('my_database.db');
        $SQLStatement = "SELECT ADDRESS_1 FROM ClientInformation WHERE USER_ID = $user_id_input";
        $result = $db->query($SQLStatement);
        $row = $result->fetchArray();
        $db->close();
        return $row[0];
      }

      public function validateLoginWithEncrptedPassword($username, $password)
      {
        $db = new SQLite3('my_database.db');
        $SQLStatement = "SELECT * FROM UserCredentials";
        $result = $db->query($SQLStatement);

        while($row = $result->fetchArray())
        {
          if ($username == $row[1] && password_verify($password, $row[2]))
          {
            $db->close();
            return "true";
          }
        }
        $db->close();
        return "false";
      }
}
