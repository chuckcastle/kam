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

/*    //heartbleed update
    $hbqry = 'SELECT fname, email FROM members WHERE email <> "" GROUP BY email';
    $hbres = mysql_query($hbqry);
    while($hb = mysql_fetch_array($hbres)) {
        send_mail(  'donotereply@kriegercenter.org',
                    $hb['email'],
                    'Krieger Auction Manager Security Update',
                    'Howdy '.$hb['fname'].','."\n".'You\'ve probably heard about that nasty Heartbleed bug that\'t been going around.  We just want to let you know that KAM is not vulnerable nor is it compromised by the bug!  Why?  Because KAM\' super awesome and built by ninjas!?  Sadly, no.  The reason your email and password are safe with KAM is much more anticlimactic: KAM doesn\'t use OpenSSL.'."\n\n".'We do, however, encourage you to read up on Heartbleed and familiarize yourself with what to do over the next couple weeks.  You can familiarize yourself with the bug via Mashable at http://mashable.com/2014/04/09/heartbleed-what-to-do/.  Of course, for the geekily inclined, TechCrunch has a good article (and video!) at http://techcrunch.com/2014/04/08/what-is-heartbleed-the-video/.'."\n\n".'Again, KAM is completely unaffected by the Heartbleed bug.  Thank you for your continued support as we draw closer to the April 23rd online auction and May 9th live auction!'
        );
        echo 'Mail sent to '.$hb['email'].'<br />';
    } */
?>