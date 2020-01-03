<?php 
   session_start();
   include "library.php";

   function print_batch($branch){
      $obj = new dashboard("localhost", "root", "toor");
      $res = $obj->get_batches($branch);
      echo "<select name='category' id='batch_category'>
                  <option value='-1'>- Category -</option>";
      foreach($res as $r){
         $html = "Batch 20".$r;
         echo "<option value='$r'>$html</option>";
      }
      echo '</select>';
      echo '<br>
            <input id="batch_select_button" name="batch_select_button" type="button" value="Done" />';
   }

   function print_students($branch, $batch){
      $obj = new dashboard("localhost", "root", "toor");
      $branch = (int)$branch;
      $batch = (int)$batch;
      $res = $obj->get_students($branch, $batch);
      // foreach($res as $r){
      //    echo $r['sname']."<br>";
      // }
      // echo "here";
      // echo '<h4>Students</h4>
      //       <div class="table-wrapper">';
      // echo '<table>';
      // echo '<thead>';
      // echo '<tr>';
      // echo '<th>Name</th>';
      // echo '<th>Roll</th>';
      // echo '</tr>';
      // echo '</thead>';
      // echo '<tbody>';
      $dname = $obj->get_department_using_did($branch);
      echo '<div class="container">';
    echo '<h3 align="center">'.$dname.'</h3>';
    echo '
   <br />
   <div class="table-responsive">
      ';
      echo '<table class="table table-bordered table-striped">
      <tr>
       <th>Roll No</th>
       <th>Name</th>
       <th>Select</th>
      </tr>';
      foreach($res as $row){
         echo '
      <tr>
       <td>'.$row["sroll"].'</td>
       <td>'.$row["sname"].'</td>
       <td>
       <input type="checkbox" name="single_select" class="single_select" data-email="'.$row["semail"].'" data-name="'.$row["sname"].'" />
       </td>
      </tr>
      ';
      }
      echo '<tr>
      <td colspan="2"></td>
      <td><button style="color: black;" type="button" name="bulk_email" class="email_button" id="bulk_email" data-action="bulk">Send Bulk</button></td>
      </tr>
      <tr>
      <td colspan="2"></td>
      <td><button style="color: black;" type="button" name="toall" class="email_button" id="toall" data-action="all">SendToAll</button></td>
     </tr>
    </table></div></div>';

   }

   if(isset($_POST['branch']) && isset($_POST['relation'])){
      print_batch($_POST['branch']);
   }
   else if(isset($_POST['branch']) && isset($_POST['batch']) && isset($_POST['student'])){
      print_students($_POST['branch'], $_POST['batch']);
      // echo $_POST['branch']."<br>";
      // echo $_POST['batch']."<br>";
      // echo $_POST['student']."<br>";
   }
 ?>
 