<?php 
 $filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
 
?>


<?php
 
class User{
	
	private $db;
	private $fm;

    public	function __construct(){
       $this->db   = new Database();
       $this->fm   = new Format();
	}

 public function customerRegistration($data){
 	$name   	 =  mysqli_real_escape_string($this->db->link, $data['name'] );
 	$address     =  mysqli_real_escape_string($this->db->link, $data['address'] );
 	$city   	 =  mysqli_real_escape_string($this->db->link, $data['city'] );
 	$country     =  mysqli_real_escape_string($this->db->link, $data['country'] );
 	$zip    	 =  mysqli_real_escape_string($this->db->link, $data['zip'] );
 	$phone       =  mysqli_real_escape_string($this->db->link, $data['phone'] );
 	$email       =  mysqli_real_escape_string($this->db->link, $data['email'] );
 	$pass        =  mysqli_real_escape_string($this->db->link, md5($data['pass']));
 	 if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == ""  || $email == ""  || $pass == "" ) {
     	$msg = "<span class='error'>Field Must Not be empty .</span> ";
    			return $msg;
     }
     $mailquery = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
     $mailchk = $this->db->select($mailquery);
     if ($mailchk != false) {
     	$msg = "<span class='error'>Email already exist.</span> ";
    			return $msg;
     }else {
     	 $query = "INSERT INTO tbl_customer(name, address, city, country, zip, phone, email, pass) 
          VALUES ('$name','$address','$city','$country','$zip','$phone','$email','$pass')";  

          $inserted_row = $this->db->insert($query);
          if ($inserted_row) {
    			$msg = "<span class='success'>Customer Data Inserted Successfully.</span> ";
    			return $msg;
    		}else {
    			$msg = "<span class='error'>Customer Data Not Inserted .</span> ";
    			return $msg;
    		} 
 
     }
 	  
 }

    public function customerLogin($data){
    $email       =  mysqli_real_escape_string($this->db->link, $data['email'] );
 	$pass        =  mysqli_real_escape_string($this->db->link, md5($data['pass']));
     if ($email == ""  || $pass == "" ) {
     	$msg = "<span class='error'>Field Must Not be empty .</span> ";
    			return $msg;
     }

     $query = "SELECT * FROM tbl_customer WHERE email='$email' AND pass='$pass' ";
     $result = $this->db->select($query);
     if ($result != false) {
      $value = $result->fetch_assoc();
      Session::set("cuslogin", ture);
      Session::set("cmrId", $value['id']);
      Session::set("cmrName", $value['name']);
      header("Location:cart.php");
      }else {
      	$msg = "<span class='error'>Email Or Password Not Matched</span> ";
    			return $msg;
      }

    }


  public function getCustomerData($id){
  $query = "SELECT * FROM tbl_customer WHERE id ='$id' ";
 	$result = $this->db->select($query);
 	return $result;

  }


 public function customerUpdate($data, $cmrId) {
	$name   	 =  mysqli_real_escape_string($this->db->link, $data['name'] );
 	$address     =  mysqli_real_escape_string($this->db->link, $data['address'] );
 	$city   	 =  mysqli_real_escape_string($this->db->link, $data['city'] );
 	$country     =  mysqli_real_escape_string($this->db->link, $data['country'] );
 	$zip    	 =  mysqli_real_escape_string($this->db->link, $data['zip'] );
 	$phone       =  mysqli_real_escape_string($this->db->link, $data['phone'] );
 	$email       =  mysqli_real_escape_string($this->db->link, $data['email'] );
 	 
 	 if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == ""  || $email == "" ) {
     	$msg = "<span class='error'>Field Must Not be empty .</span> ";
    			return $msg;
     } else { 
         $query = "UPDATE tbl_customer
            SET
            name 		= '$name',
            address 	= '$address',
            city 		= '$city',
            country 	= '$country',
            zip 		= '$zip',
            phone		= '$phone',
            email 		= '$email'
            WHERE id    = '$cmrId' "; 
            $update_row  = $this->db->update($query);
            if ($update_row) {
            	$msg = "<span class='success'>Customer Data Updated Successfully.</span> ";
            	return $msg;
            }else {
            	$msg = "<span class='error'>Customer Data Not Updated .</span> ";
    			return $msg;
            }
 
     }

 }


}

?>