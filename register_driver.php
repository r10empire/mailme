<?php 
   session_start();
   include "library.php";
   function validate_register($name, $roll, $email, $password, $repassword){
   	   if(empty($name) || empty($roll) || empty($email) || empty($password) || empty($repassword)){
   	   	  echo "Please fill all field";
   	   	  exit();
   	   }
   	   $object = new login_register("localhost", "root", "toor");
   	   $status = $object->register($name, $roll, $email, $password, $repassword);
         if($status === 0){
            echo "invalid name";
            exit();
         }
         else if($status === -5){
            echo "roll already exists";
            exit();
         }
         else if($status === -2){
            echo "password and repeat password must be same";
            exit();
         }
         else if($status === -3){
            echo "invalid email";
            exit();
         }
         else if($status === -4){
            echo "invalid branch";
            exit();
         }
         else if($status === -1){
            echo "invalid roll";
            exit();
         }
         else if($status === -6){
            echo "something went wrong";
            exit();
         }
         else{
            // everything correct
            echo "Registered";
            exit();
         }
   }
   if(isset($_POST['register'])){
   	   validate_register($_POST['name'], $_POST['roll'], $_POST['email'], $_POST['password'], $_POST['repassword']);
   }
 ?>