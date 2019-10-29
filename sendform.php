<?php
session_start();
if(!isset($_SESSION))
{
	header ('location: index.php');
}
header('Content-Type: application/json');
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$errors = array();
if(!isset($_POST))
{
	$errors[] = "Invalid POST call!";
}
$_SESSION['post'] = $_POST;
$validations = array('first-name' => '.+', 'last-name' => '.+', 'gender' => 'm|f|x', 
										'email' => 'email', 'country' => '[A-Z]{2}', 'subject' => '.+', 'message' => '.*');

foreach($validations as $key => $validation)
{
	if(!isset($_POST[$key]))
	{
		$errors[$key] = "'".$key."' value is missing";
	}
	else
	{
		if($validation == 'email')
		{
			if (!filter_var($_POST[$key], FILTER_VALIDATE_EMAIL)) {
				$errors[$key] = "Invalid address mail";
			}
		}	
		elseif(!preg_match('/'.$validation.'/u', $_POST[$key]))
		{
			$errors[$key] = "Invalid value for '".$key."'";
		}
	}
}
$ini_array = parse_ini_file("password.ini");
	
if(isset($ini_array['password']))
{
	$password = $ini_array['password'];
}
else
{
	$errors[] = 'file password.ini is missing';
}
	
if(empty($errors))
{
	
	$mail = new PHPMailer(true);
	try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'serge.bayet1975@gmail.com';                     // SMTP username
    $mail->Password   = $password;                               // SMTP password
    $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('serge.bayet1975@gmail.com', 'Mailer');
    $mail->addAddress('serge.bayet1975@gmail.com');
													// Set email format to HTML
		$mail->isHTML(true);      
    $mail->Subject = $_POST['subject'];
    $mail->Body    = "<h2>Message from ".$_POST['first-name']." ".$_POST['last-name'].' ('.$_POST['gender'].') from '.$_POST['country'].'</h2><p>'.$_POST['message'].'</p>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
	} catch (Exception $e) {
		$errors[] = $mail->ErrorInfo;
	}
}
$_SESSION['error'] = $errors;
header('location: index.php');

?>