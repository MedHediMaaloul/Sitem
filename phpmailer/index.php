<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once 'vendor/autoload.php';
$mail=new PHPMailer();
$mail->isSMTP();
$mail->SMTPAuth= true;
$mail->SMTPDebug= 2;
$mail->Host = "smtp.gmail.com";
$mail->Username = "sahlihadil76@gmail.com";
$mail->Password="qsbmnilbfkkamufq";
$mail->SMTPSecure="tls"; // or we can use ssl
$mail->Port=587;// 465

$mail->From="sahlihadil76@gmail.com"; // or we can use ssl
$mail->addAddress("malek.moslahh@gmail.com",'malek'); 
$mail->addReplyTo("sahlihadil76@gmail.com",'Hadil Sahli'); // or we can use ssl
$mail->Subject='trying to send a message from smtp!';
$mail->isHTML(true);
$mail->Body='<b> Hello from SMTP</b> <br/>';
$mail->addAttachment('images.png', 'Attachment' );
$mail->SMTPOptions= array(
    'ssl'=>array(
        'verify_peer'=>false,
        'verify_peer_name'=>false,
        'allow_self_signed'=>false,
    )
    );if($mail->send()){
        echo 'succes!';

    }
      else {      
        echo 'There was an error!';
    }
 
?>