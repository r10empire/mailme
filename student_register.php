<?php
   session_start();
   if(isset($_SESSION['roll'])){
      header("Location: student_dashboard.php");
      exit();
   }
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
	<script src="assets/js/jquery.min.js"></script>
<!--===============================================================================================-->
</head>
	<body class="subpage">

		<!-- Header -->
			<div class="header" >
				<a href="index.php" class="logo">MailMe</a>
				<div class="header-right">
				  <a class="active" href="index.php">Home</a>
				  <a href="index.php">Teacher/Student Login</a>
				  <a href="#about">About</a>
				</div>
			</div>

			<script type="text/javascript">
				$(document).ready(function(){
					$("#student_register_button").click(function(){
						// alert("hello");
						let names = document.getElementById("name").value;
						let rolls = document.getElementById("roll").value;
						let emails = document.getElementById("email").value;
						let passwords = document.getElementById("password").value;
						let repasswords = document.getElementById("repassword").value;
						$.post("register_driver.php", {
							name: names,
							roll: rolls,
							email: emails,
							password: passwords,
							repassword: repasswords,
							register: 1
						}, function(data, status){
							$("#student_register_message").html(data);
						});
					});
				});
				// $(document).ready(function(){
				// 	$("#student_login_button").click(function(){
				// 		let rolls = document.getElementById("login_roll").value;
				// 		let passwords = document.getElementById("login_password").value;
				// 		$.post("login_driver.php", {
				// 			roll: rolls,
				// 			password: passwords,
				// 			login: 1
				// 		}, function(data, status){
				// 			$("#student_login_message").html(data);
				// 		});
				// 	});
				// });
			</script>

			<div class="divider" style="background-image: url('images/bg-registration-form-2.jpg')"  >

			<div class="container" id="content">
					<!-- Jumbotron Header -->
					<div class="jumbotron home-spacer" id="products-jumbotron">
						<h1 style="text-align: center">Welcome to MailMe Registration</h1>
					</div>
					<hr >
            </div>
             
            <div class="row">
             <div class="col-md-2">

             </div>
            <div class="container-login100-1 " class="col-md-8" style="width:70%;" >
                    <div class="wrap-login100-1"  style="border:1px solid rgb(87,184,70)" style="height:100%;">
                        <div class="login100-pic js-tilt" data-tilt  >
                            <img src="images/img-01.png" alt="IMG">
                        </div>
        
                        <div class="login100-form" >
                            <span class="login100-form-title" >
                                Student Registration
                            </span>
        
                            <div class="wrap-input100" data-validate = "Name is required">
                                <input id="name" class="input100" type="text" name="name" placeholder="Name">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="wrap-input100" data-validate = "Roll Number is required">
                                    <input id="roll" class="input100" type="number" name="pass" placeholder="Roll Number">
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="wrap-input100" data-validate = "Valid email is required: ex@abc.xyz">
                                        <input id="email" class="input100" type="text" name="email" placeholder="Email">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                <div class="wrap-input100" data-validate = "Password is required">
                                        <input id="password" class="input100" type="password" name="pass" placeholder="Password">
                                        <span class="focus-input100"></span>
                                        <span class="symbol-input100">
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <div class="wrap-input100" data-validate = "Password is required">
                                            <input id="repassword" class="input100" type="password" name="pass" placeholder="Re-Enter Password">
                                            <span class="focus-input100"></span>
                                            <span class="symbol-input100">
                                                <i class="fa fa-lock" aria-hidden="true"></i>
                                            </span>
                                        </div>
                            <div class="container-login100-form-btn">
                                <button id="student_register_button" class="login100-form-btn">
                                    Register
                                </button>

                            </div>
                            <div class="text-center p-t-12">
								<a class="txt2" href="index.php">
									For Login
									<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
								</a>
							</div>
                            <br>
                            <h5 id="student_register_message" style="color: red;"></h5>
                       
                    </div>
                    </div>
                    </div>
                </div>
            </div>



		<!-- Three -->
			<!-- <section id="three" class="wrapper align-center">
				<div class="inner">
					<div class="flex flex-2">
						<article>
							<h2>Student Register</h2>
							<input type="text" name="demo-name" id="name" value="" placeholder="Name" /><br>
							<input type="text" name="demo-name" id="roll" value="" placeholder="Roll Number" /><br>
							<input type="email" name="demo-name" id="email" value="" placeholder="Email" /><br>
							<input type="password" name="demo-name" id="password" value="" placeholder="Password" /><br>
							<input type="password" name="demo-name" id="repassword" value="" placeholder="Repeat Password" /><br>
							<input name="student_register_button" id="student_register_button" type="button" value="Register" />
							<h4 id="student_register_message" style="color: red;"></h4>
						</article>
						<article>
							<h2>Student Login</h2>
							<input type="text" name="demo-name" id="login_roll" value="" placeholder="Roll Number" /><br>
							<input type="password" name="demo-name" id="login_password" value="" placeholder="Password" /><br>
							<input id="student_login_button" type="button" value="Login" />
							<h4 id="student_login_message" style="color: red;"></h4>
						</article>
					</div>
				</div>
			</section> -->

			<!-- four -->
			<!-- <section id="four" class="wrapper align-center">
				<div class="inner">
					<div class="flex flex-2">
						<article>
							<h2>Teacher Login</h2>
							<form method="post" action="#">
								<input type="text" name="demo-name" id="demo-name" value="" placeholder="Username" /><br>
								<input type="password" name="demo-name" id="demo-name" value="" placeholder="Password" /><br>
								<input type="submit" value="Login" />
							</form>
						</article>
					</div>
				</div>
			</section> -->

		<!-- Footer -->
			

		<!-- Scripts -->
		<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
		<script src="vendor/bootstrap/js/popper.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
		<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
		<!-- <script src="vendor/tilt/tilt.jquery.min.js"></script> -->
		<script >
			$('.js-tilt').tilt({
				scale: 1.1
			})
		</script>
	<!--===============================================================================================-->
		<script src="js/main.js"></script>

	</body>
</html>