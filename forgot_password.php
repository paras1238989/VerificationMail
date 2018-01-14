<?php

if(isset($_POST['submit']) )
{

	$email=strip_tags($_POST['email']);

	$error = array();
	
	$qry = array("email" => $email);
	$connection = new MongoClient();

	$db=$connection->mdc;
	$collection=$db->createCollection("registered_user");
	 
	
	$count=$collection->findOne($qry);
	if(count($count))
	{
		$id=$count['_id'];
	}echo $id;
 
	
									
								require("phpmailer/class.phpmailer.php");

								$mail = new PHPMailer();

								$mail->IsSMTP();                                      // set mailer to use SMTP
								$mail->Host = "smtp.gmail.com";  // specify main and backup server
								$mail->SMTPSecure = 'tls';
								$mail->SMTPDebug = 1;
								$mail->SMTPAuth = true;     // turn on SMTP authentication
								$mail->Username = "mdctestmail@gmail.com";  // SMTP username
								$mail->Password = "mdctestmail123"; // SMTP password
								$mail->port=465;
								$mail->From = "admin@mdcconcepts.com";
								$mail->FromName = "MDC";
								$mail->AddAddress($email);
								$mail->WordWrap = 50;                              
								$mail->IsHTML(true);                                  // set email format to HTML

								$mail->Subject = "Change password";
								$mail->Body    = "Change password link <a href='localhost/mdc/change_password.php?key=$id'>here</a> : </b>";

								if(!$mail->Send())
								{
								   //echo "Message could not be sent. <p>";
								   //echo "Mailer Error: " . $mail->ErrorInfo;
								   //exit;
								}

	
}
?>