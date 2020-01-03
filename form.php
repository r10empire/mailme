<html>
<head>
<title>entry_form</title>
<style>
.colour
{
    color :#FF0000;
}
</style>
</head>
<body>
<?php
$ename=$eemail=$egender=$erollno=$ebranch="";
$name1=$email1=$gender1=$rollno1="";
$flag=1;
function check($name1)
{
    $name1=trim($name1);
    $name1=stripcslashes($name1);
    $name1=htmlspecialchars($name1);
    return $name1;
}
if($_SERVER["REQUEST_METHOD"]=="POST")
{
$name=$_POST["name"];
$rollno=$_POST["rollno"];
$email=$_POST["email"];
$branch=$_POST["branch"];
$gender=$_POST["gender"];
if(empty($_POST["name"]))
{
$ename= "Name is required";
$flag=0;
}
else{
    $name1=check($_POST["name"]);
    if(!preg_match("/^[a-zA-Z ]*$/",$name1));
    {$ename="only white space and letters are allowed"; 
     //$flag=0;
    }
}
if(empty($_POST["email"]))
{
$eemail="Email is required";
$flag=0;}
else{
    $email1=check($_POST["email"]);
    if(!filter_var($email1,FILTER_VALIDATE_EMAIL))
    {$eemail="Invalid email address";
    $flag=0;}
}
if(empty($_POST["gender"]))
{
    $egender="Gender is empty";
$flag=0;}
else
{
    $gender1=check($_POST["gender"]);
}
if(empty($_POST["rollno"]))
{ $erollno="Roll no. is required";
$flag=0;}
else
{   //$rollno1=$_POST["rollno"];
    if(intval($rollno/100000)!=17)
    {$erollno="Only for 3rd year";
        $flag=0;
    }
    else
    $rollno1=$_POST["rollno"];
}
if(empty($_POST["branch"]))
{
    $ebranch="branch name is required";
    $flag=0;
}
if($flag==1)
{
    $username='root';
    $password='';
    $servername='localhost';
    $database='student';
    $con=mysqli_connect($servername,$username,$password,$database);
    if(!$con)
    echo "conncection failed";
    else
    echo "connection established";
    $sql="insert into student_name(roll_no,name,e_mail,branch,gender) values ($rollno1,'$name1','$email1','$branch','$gender')";
    if(mysqli_query($con,$sql))
    echo "data inserted successfully";
    else
    echo "data gone".mysqli_error($con);
    $con->close();
    //header("refresh:3,url=form.php");
}
}
?>
<h1>CSE & IT Form 2K17</h1>
<span class="colour">*All fields are required</span><br>
<br>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Name:  <input type="text" placeholder="enter name" name="name" ><span class="colour">*<?php echo "$ename";?></span><br><br>
Roll.No:  <input type="text" placeholder="enter roll_no" name="rollno"><span class="colour">*<?php echo "$erollno";?></span><br><br>
E-mail:  <input type="text" placeholder="Enter email" name="e_mail"><span class="colour">*<?php echo "$eemail";?></span><br><br>
Branch:  <select name="branch">
<option value=""></option>
<option value="Information Technology">Information technology</option>
<option value="Computer science">Computer science</option>
</select><span class="colour">*<?php echo "$ebranch"?></span>
<br><br>
Gender:  <select name="gender">
<option value=""></option>
<option value="male">Male</option>
<option value="female">Female</option>
</select><span class="colour">*<?php echo "$egender";?></span><br><br>
<input type="submit" value="Submit" name="submit" >
</form>
</body>
</html>