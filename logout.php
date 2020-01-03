<?php 
   session_start();
   if(isset($_SESSION['roll'])){
       unset($_SESSION['roll']);
       header("Location: index.php");
       exit();
   }
   else if(isset($_SESSION['teacher_id'])){
          unlink($_SESSION['file']);
          unset($_SESSION['teacher_id']);
          unset($_SESSION['name']);
          unset($_SESSION['body']);
          unset($_SESSION['subject']);
          unset($_SESSION['file']);
       header("Location: index.php");
       exit();
   }
 ?>