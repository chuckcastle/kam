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

/*    //select YES donate from org table
    $yesqry = 'SELECT * FROM org WHERE donate = 1 ORDER BY name ASC';
    $yesres = mysql_query($yesqry);
    while($row = mysql_fetch_array($yesres)) {
        $itmqry = 'SELECT * FROM items WHERE org_id = '.$row['id'].' AND received = 1';
        $itmres = mysql_query($itmqry);
        $items = mysql_num_rows($itmres);
        if($items==0) {
            $sendqry = 'SELECT members.email, members.fname, org.name FROM members JOIN org ON org.usr_id = members.id WHERE org.id = '.$row['id'];
            $sendres = mysql_query($sendqry);
            $send = mysql_fetch_array($sendres);
            send_mail(  'donotreply@kriegercenter.org',
                        $send['email'],
                        'Krieger Auction Manager: Pending receipt of donation',
                        'Hey, '.$send['fname'].'! Thanks for soliciting from '.$send['name'].'. Don\'t forget to follow up with them as we have not received their donation.  Thank you for helping make our event a success!'
            );
            echo 'Mail sent to '.$send['email'].'<br />';
        } else {
            $donothing = 1;
        }
    } */
?>