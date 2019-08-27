<?php 
 $filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../config/config.php');
 
?>

 

<?php
 class Database {

public $host = DB_HOST;
public $user = DB_USER;
public $pass = DB_PASS;
public $dbname = DB_NAME;

 public $link;
 public $error;


   public function __construct(){
   	$this->connectDB();
   }




 private function connectDB(){

   $this->link = new mysqli($this->host,$this->user, $this->pass, $this->dbname);

    if(!$this->link) {
    
     $this->error ="connection fail".$this->link->connect_error;
       return false;
    }
 }
    // Select or Rread Data From Database 
   
     public function select($query){
    $result = $this->link->query($query) or die ($this->link->error.__LINE__);
    if($result->num_rows > 0){
    	return $result;
    	    } else {
    	    	return false;
    	    }   

     }

   // Create Data in to the database 

   public function insert($query){
   $insert_row = $this->link->query($query) or die ($this->link->error.__LINE__);
   if($insert_row){
   	 return $insert_row;
   	exit();
   	   } else {
   	   	return false;

   	   }

   }

   /// Update Data in to the database

   public function update($query){
   $update_row = $this->link->query($query) or die ($this->link->error.__LINE__);
   if($update_row){
   	return $update_row;
   	exit();
   	   } else {
   	   	return false;

   	   }

   }




/// Delete Data in to the database

   public function delete($query){
   $delete_row = $this->link->query($query) or die ($this->link->error.__LINE__);
   if($delete_row){
   return $delete_row;
   	exit();
   	   } else {
   	  return false;

   	   }

   }





 }


?>