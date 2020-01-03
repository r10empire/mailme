<?php 
   session_start();
if(isset($_POST["submit"]))
 {
	$_SESSION["name"]=$_POST["name"];
	$_SESSION["body"]=$_POST["body"];
	$_SESSION["subject"]=$_POST["subject"];
	if(is_uploaded_file($_FILES['attachment']['name']))
	{
		$arr = array("jpg", "pdf", "png", "jpeg");
		$tmp=explode('.',$_FILES['attachment']['name']);
		$file_ext = end($tmp);
		if(in_array($file_ext,$arr)=== false){
			header("Location: teacher_form.php?message=pdf, jpg, jpeg, png file extensions are allowed");
			exit();
		}
		else if($_FILES['attachment']['size'] === 0 || $_FILES['attachment']['size'] > 1048576){
			header("Location: teacher_form.php?message=File size must be > 0 and < 1MB");
			exit();
		}
	}
   if (isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != "") {
			$file = "attachment/" . basename($_FILES['attachment']['name']);
			move_uploaded_file($_FILES['attachment']['tmp_name'], $file);
		}else
		$file="";
 $_SESSION["file"]=$file;
}
   if(!isset($_SESSION['teacher_id'])){
   	   header("Location: index.php");
	   exit();
   }

   include "library.php";
   $object = new dashboard("localhost", "root", "toor");
   $res = $object->get_departments();
//    echo "hello";
//    echo $_SESSION["file"];
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Student Registeration</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<script src="assets/js/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body class="subpage">
	<!-- Header -->
	<div class="header" >
		<a href="index.php" class="logo">MailMe</a>
		<div class="header-right">
		  <a class="active" href="index.php">Home</a>
		  <a href="logout.php">Logout</a>
		  <a href="teacher_form.php">SendMail</a>
		  <a href="#about">About</a>
		</div>
	</div>
	<div class="event_scripts">
		<script type="text/javascript">
			let branch;
			let batch;
			$(document).ready(function(){
				$("#branch_select_button").click(function(){
					branch = document.getElementById("branch_category").value;
					if(branch !== -1){
						$.post("dashboard_driver.php", {
							branch: branch,
							relation: 1
						}, function(data, status){
							$("#batches").html(data);
							if(status === "success"){
								$("#batch_select_button").click(function(){
									batch = document.getElementById("batch_category").value;
									if(batch !== -1){
										$.post("dashboard_driver.php", {
											batch: batch,
											branch: branch,
											student: 1
										}, function(data, status){
											$("#students").html(data);
											if(status==='success')
											{
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
											}
										});
									}
								});
							}
						});
					}
				});
				// $("#batch_select_button").click(function(){
				// 	batch = document.getElementById("batch_category").value;
				// 	alert("button clicked");
				// 	if(batch !== -1){
				// 		$.post("dashboard_driver.php", {
				// 			batch: batch,
				// 			branch: branch,
				// 			student: 1
				// 		}, function(data, status){
				// 			$("#students").html(data);
				// 		});
				// 	}
				// });
			});
		</script>
	</div>
	<section id="main" class="wrapper">
		<div class="inner">
			<h2 id="branch_content">Select Branch</h2>
			<div class="12u$">
				<div class="select-wrapper">
					<select name="category" id="branch_category">
						<option value="-1">- Category -</option>
						<?php 
						   $i = 0;
						   while($i < count($res)){
						   	  $did = $res[$i]['did'];
						   	  $dname = $res[$i]['dname'];
						   	  echo "<option value='$did'>$dname</option>";
						   	  $i++;
						   }
						 ?>
						
					</select>
				</div>
				<br>
				<input id="branch_select_button" name="branch_select_button" type="button" value="Done" />
			</div>
			<br>
			<div id="batches">
			</div>
			<br>
			<div class ="container" id="students">
			</div>
		</div>
	</section>
			
	        <script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

</body>
</html>