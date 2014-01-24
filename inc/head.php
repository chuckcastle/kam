<?php
define('INCLUDE_CHECK',true);

//global requirements
require 'inc/connect.php';
require 'inc/functions.php';

//session config
session_name('eceLogin');
session_set_cookie_params(2*7*24*60*60);
session_start();


if($_SESSION['id'] && !isset($_COOKIE['eceRemember']) && !$_SESSION['rememberMe'])
{
	$_SESSION = array();
	session_destroy();
}

//logoff
if(isset($_GET['logoff']))
{
	$_SESSION = array();
	session_destroy();
	
	header("Location: index.php");
	exit;
}

//login
if($_POST['submit']=='Login')
{	
	$err = array();
	
	if(!$_POST['username'] || !$_POST['password'])
		$err[] = 'Uh oh... You kinda gotta fill all the boxes in :/';
	
	if(!count($err))
	{
		$_POST['username'] = mysql_real_escape_string($_POST['username']);
		$_POST['password'] = mysql_real_escape_string($_POST['password']);
		$_POST['rememberMe'] = (int)$_POST['rememberMe'];

		$row = mysql_fetch_assoc(mysql_query("SELECT id,usr,acc FROM members WHERE usr='{$_POST['username']}' AND pass='".md5($_POST['password'])."'"));

		if($row['usr'])
		{
			$_SESSION['usr']=$row['usr'];
			$_SESSION['id'] = $row['id'];
			$_SESSION['acc'] = $row['acc'];
			$_SESSION['rememberMe'] = $_POST['rememberMe'];
			
			setcookie('eceRemember',$_POST['rememberMe']);
			
			$_SESSION['msg']['success']='Hey! You\'re now logged in as '.$_SESSION['usr'];
			
			$dt = date("Y-m-d H:i:s");
			
			mysql_query('UPDATE members SET lastlogin = "'.$dt.'" WHERE id = '.$_SESSION['id'].' LIMIT 1');
		}
		else $err[]='Aw snap! You entered a bad username and/or password :(';
	}
	
	if($err)
	$_SESSION['msg']['error'] = implode('<br />',$err);

	header("Location: solicit.php");
	exit;
}

//register
else if($_POST['submit']=='Register')
{	
	$err = array();
	
	if(strlen($_POST['username'])<4 || strlen($_POST['username'])>12)
	{
		$err[]='Not so fast! Your username\'s gotta be between 4 and 12 characters!';
	}
	
	if($_POST['pass']!=$_POST['vpass'])
	{
		$err[]='Oops!  Passwords don\'t match!';
	}
	
	if(preg_match('/[^a-z0-9\-\_\.]+/i',$_POST['username']))
	{
		$err[]='Whoops! Your username contains invalid characters!';
	}
	
	if(!checkEmail($_POST['email']))
	{
		$err[]='Wait a minute... that\'s not a valid email address...';
	}
	
	if(!count($err))
	{		
		$pass = md5($_POST['vpass']);

		$_POST['email'] = mysql_real_escape_string($_POST['email']);
		$_POST['username'] = mysql_real_escape_string($_POST['username']);
		
		mysql_query("INSERT INTO members(fname,lname,usr,pass,email,regIP,dt,acc,assign,sub,class_id,class_id2)
						VALUES(
							'".nameize($_POST['fname'])."',
							'".nameize($_POST['lname'])."',
							'".$_POST['username']."',
							'".$pass."',
							'".$_POST['email']."',
							'".$_SERVER['REMOTE_ADDR']."',
							now(),
							4,
							1,
							'".$_POST['sub']."',
							'".$_POST['class']."',
							'".$_POST['class2']."'
						)");
						
		$p1qry = 'SELECT name, parent1 FROM class LEFT JOIN members ON members.id = class.parent1 WHERE class_id = '.$_POST['class'].' LIMIT 1';
		$p1res = mysql_query($p1qry);
		$p1rows = mysql_num_rows($p1res);
		
		$p1 = '';
		$p2 = '';
		
		if($p1rows == 0){
			$p1 = '11';
		}
		
		$p2qry = 'SELECT name, parent2 FROM class LEFT JOIN members ON members.id = class.parent2 WHERE class_id = '.$_POST['class2'].' LIMIT 1';
		$p2res = mysql_query($p2qry);
		$p2rows = mysql_num_rows($p2res);

		mysql_query("INSERT INTO msg(text,usr_id,new,dt)
						VALUES(
							'".$_POST['fname']." ".$_POST['lname']." registered an account.',
							'".$p1."',
							1,
							now()
						)");

        if($p2rows == 0){
            if($p2 != $p1 and $p2 != 0){
                mysql_query("INSERT INTO msg(text,usr_id,new,dt)
                VALUES(
                '".$_POST['fname']." ".$_POST['lname']." registered an account.',
                '".$p2."',
                1,
                now()
                )");
            }
        }
		
		if(mysql_affected_rows($link)==1)
		{
			send_mail(	'donotreply@kriegercenter.org',
						$_POST['email'],
						'Welcome to the Krieger Auction Manager!',
						'Hey! Thanks for registering a new account.'."\n\n".'Your username is: '.$_POST['username']."\n".'Your password is: '.$_POST['vpass']."\n\n".'You can login at http://auction.kriegercenter.org'."\n\n".'--'."\n".'Please do not reply to this email.  If you do, a baby unicorn will fall from the sky and land on a baby seal.');

			$_SESSION['msg']['success']='Welcome to KAM!  You may now log in.  Your account info has been emailed to you for safe keeping :)';
		}
		else $err[]='Aw man! This username is already taken!';
	}

	if(count($err))
	{
		$_SESSION['msg']['error'] = implode('<br />',$err);
	}	
	
	header("Location: index.php");
	exit;
}

?>
