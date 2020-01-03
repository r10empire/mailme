<?php 
    session_start();
    include "library.php";

    function validate_login($roll, $password){
       if(empty($roll) || empty($password)){
       	  echo "Please fill all fields";
       	  exit();
       }
   	   $object = new login_register("localhost", "root", "toor");
   	   $status = $object->studentLogin($roll, $password);
       if($status === 0){
          echo "Wrong credentials";
          exit();
       }
       else{
          $_SESSION['roll'] = $roll;
          echo "correct";
          echo "<script>window.location.href='student_dashboard.php';</script>";
          exit();
       }
   }

   function update_details($roll, $name, $email, $pass, $repass){
      $old_roll = $_SESSION['roll'];
      $object = new dashboard("localhost", "root", "toor");
      $status = $object->update_student_details($roll, $_SESSION['roll'], $name, $email, $pass, $repass);
      if(empty($roll) || empty($name) || empty($email) || empty($pass) || empty($repass)){
         echo "Please fill all fields";
         exit();
      }
      else if($status === -1){
         echo "roll already exists";
         exit();
      }
      else if($status === -2){
         echo "invalid email";
         exit();
      }
      else if($status === -3){
         echo "password and repeat password must be same";
         exit();
      }
      else if($status === -4){
         echo "invalid name";
         exit();
      }
      else if($status === -5){
         echo "invalid branch";
         exit();
      }
      else if($status === -6){
         echo "wrong password";
         exit();
      }
      else if($status === 0){
         echo "something went wrong";
         exit();
      }
      else{
         $_SESSION['roll'] = $roll;
         echo "updated successfully";
         exit();
      }
   }

   function change_password($oldpass, $newpass){
      $roll = $_SESSION['roll'];
      $object = new dashboard("localhost", "root", "toor");
      $status = $object->update_password($roll, $newpass, $oldpass);
      if(empty($oldpass) || empty($newpass)){
         echo "Please fill all fields";
         exit();
      }
      else if($status === -1){
         echo "invalid old password";
         exit();
      }
      else if($status === 0){
         echo "something went wrong";
         exit();
      }
      else{
         echo "update successfully";
         exit();
      }
   }

   function login_teacher($id, $pass){
      $teacher_id = "12345";
      $teacher_password = "123456";
      if(empty($id) || empty($pass)){
          echo "Please Fill all fields";
          exit();
      }
      else if(strcmp($id, $teacher_id) === 0 && strcmp($pass, $teacher_password) === 0){
          $_SESSION['teacher_id'] = $id;
          echo "<script>window.location.href='teacher_form.php';</script>";
          exit();
      }
      else{
          echo "wrong credentials";
          exit();
      }
   }

   if(isset($_POST['login'])){
   	   validate_login($_POST['roll'], $_POST['password']);
   }
   else if(isset($_POST['update'])){
       update_details($_POST['roll'], $_POST['name'], $_POST['email'], $_POST['pass'], $_POST['repass']);
   }
   else if(isset($_POST['password'])){
       change_password($_POST['oldpass'], $_POST['newpass']);
   }
   else if(isset($_POST['teacher_login']) && isset($_POST['id']) && isset($_POST['pass'])){
       login_teacher($_POST['id'], $_POST['pass']);
   }

 ?>