<?php

error_reporting(E_STRICT | E_ALL);

date_default_timezone_set('Asia/Kolkata');

require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
$mail->Port = 465;
$mail->Username = 'anonymous.code.anonymous@gmail.com';
$mail->Password = 'Ayanahmad2001.';
$mail->setFrom('anonymous@gmail.com', 'Balance due');
$mail->SMTPDebug = 1;
$mail->SMTPSecure = 'ssl';
$mail->Subject = "Hello";

//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';

//Connect to the database and select the recipients from your mailing list that have not yet been sent to
//You'll need to alter this to match your database
$result = array(array('email'=>'anonymous.code.anonymous@gmail.com',"full_name"=>"Ayan Ahmad"));
foreach ($result as $row) { //This iterator syntax only works in PHP 5.4+
    $mail->addAddress($row['email'], $row['full_name']);
	$mail->msgHTML("Dear ".$row['full_name']."<br> <h1>Testing Mail</h1>");

#    if (!empty($row['photo'])) {
#        $mail->addStringAttachment($row['photo'], 'YourPhoto.jpg'); //Assumes the image data is stored in the DB
#    }

    if (!$mail->send()) {
        echo "Mailer Error (" . str_replace("@", "&#64;", $row["email"]) . ') ' . $mail->ErrorInfo . '<br />';
        break; //Abandon sending
    } else {
        echo "Message sent to :" . $row['full_name'] . ' (' . str_replace("@", "&#64;", $row['email']) . ')<br />';
        //Mark it as sent in the DB
    }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments();
}
