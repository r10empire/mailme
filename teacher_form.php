<?php
   session_start();
   if(!isset($_SESSION['teacher_id'])){

      header("Location: index.php");
      exit();
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Teacher Form</title>
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
<!--===============================================================================================-->
</head>
<body>
        <div class="header" >
				<a href="index.php" class="logo">MailMe</a>
				<div class="header-right">
				  <a class="active" href="index.php">Home</a>
				  <a href="logout.php">Logout</a>
				  <a href="#about">About</a>
				</div>
			  </div>
	
		<div class="divider" style="background-image: url('images/bg-registration-form-2.jpg')"  >

			<div class="container" id="content">
					<!-- Jumbotron Header -->
					<div class="jumbotron home-spacer" id="products-jumbotron">
						<h1 style="text-align: center">Teacher Form</h1>
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
        
                        <form class="login100-form " method='post' action="teacher_dashboard.php"  enctype='multipart/form-data'>
                            <span class="login100-form-title" >
                                <?php
                                if(isset($_GET['message'])){
                                    echo $_GET['message'];
                                }
                                else{
                                    echo "Enter Details";
                                }
                                ?>
                            </span>
        
                            <div class="wrap-input100" data-validate = "Teacher Name is required">
                                <input class="input100" type="text" name="name" placeholder="Teacher Name" required>
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="wrap-input100" data-validate = "Subject is required">
                                    <input class="input100" type="text" name="subject" placeholder="Subject" required>
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="fa fa-th" aria-hidden="true"></i>
                                    </span>
                                </div>
                            

                              
                               
                                 <div class="wrap-input100"  > 
                                       <input class="input100" type="text" name="body" placeholder="Details" required>
                                          <span class="focus-input100"></span>
                                          <span class="symbol-input100">
                                                <i class="fa fa-th-list" aria-hidden="true"></i>
                                            </span>
                                 </div>
                                  <br>  
                                  <input type="file" id="file" name='attachment' >
                                     <label for="file" class="btn-2">Choose File</label>

                            <div class="container-login100-form-btn">
                                <a href="StudentRes.html">
                                <button class="login100-form-btn" name='submit' >
                                    Submit
                                </button>
                            </a>

                            </div>
                       
                    </form>
                    </div>
                    </div>
                </div>
        
	
                <footer class="site-footer">
                        <div class="container">
                          <div class="row">
                            <div class="col-sm-12 col-md-6">
                              <h6>About Us</h6>
                              <br>
                              <p class="text-justify">MailMe.com <i>MAIL EVERYONE .. </i> is an initiative  to help communication between teachers and students using mail. MailMe focuses on providing the sharing of important files among the students.</p>
                            </div>
            
                            <div class="col-xs-6 col-md-3">
                            </div>
                            
                            <div class="col-xs-6 col-md-3">
                                    <h6>Contact Us</h6>
                                    <br>
                                    <p>Email: sdjs@gmail.com</p><br>
                                    <p>phone: +91 9876543210</p>
                            </div>
                            </div>
                            <hr>
                            <div class="container">
                                    
                                      
                                        <p class="copyright-text" style="text-align: center">Copyright &copy; 2019 All Rights Reserved by 
                                     <a href="#"><i>MailMe</i></a>.
                                        </p>
                                      </div>
                                     
                                     
                            </div>
                            </footer>



	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>