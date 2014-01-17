<?php
/* Database config */

$db_host		= 'kriegerdb.db.10424383.hostedresource.com';
$db_user		= 'kriegerdb';
$db_pass		= 'kr13G3R@@';
$db_database	= 'kriegerdb'; 

/* End config */



$link = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');

mysql_select_db($db_database,$link);
mysql_query("SET names UTF8");

function send_mail($from,$to,$subject,$body)
{
	$headers = '';
	$headers .= "From: $from\n";
	$headers .= "Reply-to: $from\n";
	$headers .= "Return-Path: $from\n";
	$headers .= "Message-ID: <" . md5(uniqid(time())) . "@" . $_SERVER['SERVER_NAME'] . ">\n";
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-Type: text/plain; charset=\"iso-8859-1\"\n";
	$headers .= "Date: " . date('r', time()) . "\n";

	mail($to,$subject,$body,$headers);
}

	//select proper info from msg table
	$newqry = 'SELECT COUNT(*) AS new, usr_id, members.email FROM msg INNER JOIN members ON usr_id=members.id GROUP BY usr_id';
	$newres = mysql_query($newqry);

	while($row = mysql_fetch_array($newres)){
		send_mail(	'donotreply@chuckcastle.me',
		$row['email'],
		'Krieger Auction Manager - You have '.$row['new'].' new notifications this week!',
		'Hey there!'."\n".'Please log in to your account at the Krieger Auction Management Site and check your messages.'."\n\n".'--'."\n".'Please do not reply to this email.  If you do, a baby unicorn will fall from the sky and land on a baby seal.');
	}
?>