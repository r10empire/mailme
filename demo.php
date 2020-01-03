<?php
session_start();
$_SESSION["name"]=$_POST["name"];
$_SESSION["body"]=$_POST["body"];
$_SESSION["subject"]=$_POST["subject"];
if(isset($_POST["submit"]))
 { 
 if (isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != "") {
			$file = "attachment/" . basename($_FILES['attachment']['name']);
			move_uploaded_file($_FILES['attachment']['tmp_name'], $file);
		} else
         $file = "";
 $_SESSION["file"]=$file;
}
?>
<?php
$connect = new PDO("mysql:host=localhost;dbname=student", "root", "toor");
$query = "SELECT roll_no,name,email from student_info order by roll_no";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Send Bulk Email using PHPMailer with PHP Ajax</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container">
   <h3 align="center">Information Technology</h3>
   <br />
   <div class="table-responsive">
    <table class="table table-bordered table-striped">
     <tr>
      <th>Roll No</th>
      <th>Name</th>
      <th>Email</th>
      <th>Select</th>
     </tr>
     <?php
     $count = 0;
     foreach($result as $row)
     {
      $count++;
      echo '
      <tr>
       <td>'.$row["roll_no"].'</td>
       <td>'.$row["name"].'</td>
       <td>'.$row["email"].'</td>
       <td>
        <input type="checkbox" name="single_select" class="single_select" data-email="'.$row["email"].'" data-name="'.$row["name"].'" />
       </td>
      </tr>
      ';
     }
     ?>
     <tr>
      <td colspan="3"></td>
      <td><button type="button" name="bulk_email" class="btn btn-info email_button" id="bulk_email" data-action="bulk">Send Bulk</button></td>
      </tr>
      <tr>
      <td colspan="3"></td>
      <td><button type="button" name="toall" class="btn btn-info email_button" id="toall" data-action="all">SendToAll</button></td>
     </tr>
    </table>
   </div>
  </div>
 </body>
</html>
<script>
$(document).ready(function(){
 $('.email_button').click(function(){
  $(this).attr('disabled', 'disabled');
  var id = $(this).attr("id");
  var action = $(this).data("action");
  var email_data = [];
  if(action == 'bulk')
  {
    $('.single_select').each(function(){
    if($(this). prop("checked") == true)
    {
     email_data.push({
      email: $(this).data("email"),
      name: $(this).data('name')
     });
    }
   });
  }
  else
  {
    $('.single_select').each(function(){
     email_data.push({
      email: $(this).data("email"),
      name: $(this).data('name')
     });
    });
  } 
  $.ajax({
   url:"send_mail.php",
   method:"POST",
   data:{email_data:email_data},
   beforeSend:function(){
    $('#'+id).html('Sending...');
    $('#'+id).addClass('btn-danger');
   },
   success:function(data){
    if(data = 'ok')
    {
     $('#'+id).text('Success');
     $('#'+id).removeClass('btn-danger');
     $('#'+id).removeClass('btn-info');
     $('#'+id).addClass('btn-success');
    }
    else
    {
     $('#'+id).text(data);
    }
    $('#'+id).attr('disabled', false);
   }
   
  });
 });
});
</script>
