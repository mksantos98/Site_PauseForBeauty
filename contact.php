<?php
/*
Credits: Bit Repository
URL: http://www.bitrepository.com/
*/

include 'contact_config.php';
session_start();
error_reporting (E_ALL ^ E_NOTICE);

$post = (!empty($_POST)) ? true : false;

if($post)
{
include 'functions.php';

$name = stripslashes($_POST['name']);
$subject = stripslashes($_POST['enviar']);

$email = trim($_POST['email']);
$subject = stripslashes($_POST['enviar']);
$message = "Site visitor information:

Name: ".$_POST['name']
."

E-mail Address: ".$_POST['email']
."

Subject: ".$_POST['enviar']
."


Comments: ".$_POST['content'];


$error = '';

// Check name

if(!$name)
{
$error .= 'Please enter your First name.<br />';
}
// Check email

if(!$email)
{
$error .= 'Please enter an e-mail address.<br />';
}

if($email && !ValidateEmail($email))
{
$error .= 'Please enter a valid e-mail address.<br />';
}


if(isset($_SESSION['captcha_keystring']) && strtolower($_SESSION['captcha_keystring']) != strtolower($_POST['capthca']))
{
$error .= "Incorect captcha.<br />";
}


if(!$error)
{

	$mail = mail(WEBMASTER_EMAIL, $subject, $message,
     "From: ".$name." <".$email.">\r\n"
    ."Reply-To: ".$email."\r\n"
    ."X-Mailer: PHP/" . phpversion());

if($mail)
{
echo 'OK';
}

}
else
{
echo '<div class="notification_error">'.$error.'</div>';
}

}
?>
