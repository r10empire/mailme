<?php
session_start();
?>
<?php 
use PHPMailer\PHPMailer\PHPMailer;
if(isset($_POST["email_data"]))
{
require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';
require_once 'PHPMailer/Exception.php'; 
foreach($_POST['email_data'] as $row)
{
$mail=new PHPMailer();
$mail->SMTPDebug=4;
$mail->isSMTP();
$mail->Host = 'ssl://smtp.gmail.com:465';
$mail->SMTPAuth=true;
$mail->Username="rahul10empire@gmail.com";
$mail->Password='rahuratn';
$mail->SMTPSecure="ssl";
$mail->Port=465;
$mail->Subject=$_SESSION["subject"];
$mail->Body=$_SESSION["body"];
$mail->setFrom('rahul10empire@gmail.com',$_SESSION["name"]);
$mail->AddAddress($row["email"],$row["name"]);
$mail->addAttachment($_SESSION["file"]);
$mail->smtpConnect([
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    ]
]);
$mail->send();
}
unlink($_SESSION["file"]);
/*if($result)
echo "email send";
else
echo 'some error happen'.$mail->ErrorInfo;*/
}
?>
