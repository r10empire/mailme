<?php 
   include "library.php";
   // $obj = new login_register("localhost", "root", "toor");
   // echo $obj->studentLogin("1711009", "Kuze@123");
   $obj = new dashboard("localhost", "root", "toor");
   $res = $obj->get_students(11, 17);
      foreach($res as $r){
         echo $r['sname']."\n";
      }
   // echo $arr[0]['did'];
   // echo date("d-m-y");
?>