<?php
/* Database config */

$db_host        = 'kriegerdb.db.10424383.hostedresource.com';
$db_user        = 'kriegerdb';
$db_pass        = 'kr13G3R@@';
$db_database    = 'kriegerdb';

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

//email new messages
    $newqry = 'SELECT COUNT(*) AS new, usr_id, members.email, members.opt_out FROM msg INNER JOIN members ON usr_id=members.id WHERE msg.new = "0" AND members.opt_out = "0" GROUP BY usr_id';
    $newres = mysql_query($newqry);

    while($msg = mysql_fetch_array($newres)){
        send_mail(    'donotreply@kriegercenter.org',
        $msg['email'],
        'Krieger Auction Manager - You have '.$msg['new'].' new notifications this week!',
        'Hey there!'."\n".'Please log in to your account at http://auction.kriegercenter.org and check your messages.'."\n\n".'--'."\n".'Please do not reply to this email.');
    }

/*
//email motivation
    $prtldrqry = 'SELECT members.opt_out, members.fname, members.lname, members.email, SUM(items.value) AS total FROM org JOIN members ON org.usr_id = members.id JOIN items ON items.org_id = org.id WHERE members.opt_out = "0" GROUP BY members.usr ORDER BY total DESC';
    $prtldrres = mysql_query($prtldrqry);

    while($ldr = mysql_fetch_array($prtldrres)){
        send_mail(    'donotreply@kriegercenter.org',
        $ldr['email'],
        'Krieger Auction Manager - You\'ve solicited $'.$ldr['total'].'!',
        'Hey '.$ldr['fname'].','."\n".'Thank you for your awesome work!  Thanks to your efforts, $'.$ldr['total'].' has been solicited for our center!'."\n\n".'--'."\n".'Please do not reply to this email.');
    }
*/

//email home stretch!
    $prtldrqry = 'SELECT members.opt_out, members.fname, members.lname, members.email, SUM(items.value) AS total FROM org JOIN members ON org.usr_id = members.id JOIN items ON items.org_id = org.id WHERE members.opt_out = "0" GROUP BY members.usr ORDER BY total DESC';
    $prtldrres = mysql_query($prtldrqry);

    while($ldr = mysql_fetch_array($prtldrres)){
        send_mail(    'donotreply@kriegercenter.org',
        $ldr['email'],
        'Krieger Auction Manager - We\'re on the home stretch!',
        'Hey '.$ldr['fname'].','."\n".'Guess what!?  Because of your hard work we have exceeded our initial goal of $40,000!!!  You helped us raise $'.$ldr['total'].' towards this goal with your awesomeness!'."\n\n".'There\'s still time to get those last minute solicitations in.  C\'mon, you know you wanna help make this record-breaking solicitation year the bestest ever!  One more solicitation!  One more solicitation!  One more solicitation!'."\n\n".'--'."\n".'We\'re so excited that we don\'t mind if you reply to this email... do it... you know you wanna...');
    }


?>