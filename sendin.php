<?php
        $servername="localhost";
        $username="root";
        $password="";
        $database="student";
        $con=new mysqli($servername,$username,$password,$database);
        $sql="select roll_no,name,e_mail from student_name order by roll_no";
        $result=$con->query($sql);
 ?>
<html>
 <head>
  <title>Send Bulk Email using PHPMailer with PHP Ajax</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container">
   <h3 align="center">information technology</h3>
   <br />
   <div class="table-responsive">
    <table class="table table-bordered table-striped">
     <tr>
      <th>Roll_no</th>
      <th>name</th>
      <th>Email</th> 
      <th>Select</th>
     </tr>
     <?php
     $count = 0;
     if (is_array($result) || is_object($result))
     {
     foreach($result as $row)
     {
      $count++;
     ?>
      <tr>
       <td><?php echo $row["roll_no"]?></td>
       <td><?php echo $row["name"] ?></td>
       <td><?php echo $row["e_mail"]?></td>
       <td>
       <input type="checkbox" name="single_select" class="single_select" id="'.$count.'" data-email="'.$row["e_mail"].'" data-name="'.$row["name"].'" />
       </td>
      </tr>
      <?php
     }
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
  <div id="abc"> </div>
 </body>
</html>
<script>
$(document).ready(function(){
 $('.email_button').click(function(){
  $(this).attr('disabled', 'disabled');
  var id = $(this).attr("id");
  var action = $(this).data("action");
  var email_data = [];
  if(action=="bulk")
  {
   $('.single_select').each(function(){
    if($(this). prop("checked") == true)
    {
     $("#abc").html("hello");
     email_data.push({
      email: $(this).data("e_mail"),
      name: $(this).data('name')
     });
    }
   });
  }
  else
  {
     $('.single_select').each(function(){
    if($(this). prop("checked") == true)
    {
     email_data.push({
      email: $(this).data("e_mail"),
      name: $(this).data('name')
     });
     }
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
    if(data)
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