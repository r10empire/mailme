<?php
session_start();
?>
<html>
<head>
</head>
<body>
<h1>teacher form</h1>
<form method='post' action='teacher_dashboard.php' enctype='multipart/form-data'>
<input type='text' placeholder='name..' name='name' required><br><br>
<input type='text' placeholder='subject...' name='subject' required><br><br>
<textarea name="body" placeholder='message' required ></textarea><br><br>
<input type='file' name='attachment'><br><br>
<input id='submit' type='submit' name='submit' value='Submit'>
</form>
</body>
</html>
