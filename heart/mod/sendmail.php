<?php
// Script email sending :)
$send = "yes";
if (	$httpquery->request['sender_name'] == "" ||
		$httpquery->request['sender_mail'] == "" ||
		$httpquery->request['message'] == "" ||
		( !preg_match("/^([a-z,0-9])+\@([a-z,0-9])+(\.([a-z,0-9])+)+$/", $httpquery->request['sender_mail']) )
	)
{ $send = "no"; }

if ($send != "no")
{
	// Send

//	$mail = new XpertMailer();
//	$to = 'email';
//	$mail->from($httpquery->request['sender_mail'], $httpquery->request['sender_name']);
//	$subject = $httpquery->request['subject'];
//	$msg = $httpquery->request['message'];
//	$mail->send($to, $subject, $msg);
	
	$to = 'email';
	$subject = $httpquery->request['subject'];
	$msg = $httpquery->request['message'];
	$mailheaders ="Reply-To: ".$httpquery->request['sender_mail']."\n\n";
	mail($to, $subject, $msg, $mailheaders);

	// Result
	$send_result = '<span><center>Уважаемый '.
		$httpquery->request['sender_name'].
		', ваше сообщение было успешно отправленно.</center></span>';
}
else
{
	if ($httpquery->request['sender_name'] == "")		
		$send_result = '<font color="red"> Вы не заполнили поле ИМЯ! </font>';
	
	if ($httpquery->request['sender_mail'] == "")		
		$send_result = '<font color="red">Вы не заполнили поле E-mail! </font><br />';
	else if (!preg_match("/^([a-z,0-9])+\@([a-z,0-9])+(\.([a-z,0-9])+)+$/", $httpquery->request['sender_mail']))		
		$send_result = '<font color="red"> Вы не правильно заполнили поле E-mail! </font>';
	
	if ($httpquery->request['message'] == "")		
		$send_result = '<font color="red">Вы не заполнили поле Сообщение! </font></font></span></p>
			<p><strong><span><font face="Verdana, Arial, Helvetica, sans-serif">';
}
?>