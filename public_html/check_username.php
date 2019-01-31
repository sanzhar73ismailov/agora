<?
#################################################################
## PHP Pro Bid v6.10															##
##-------------------------------------------------------------##
## Copyright �2007 PHP Pro Software LTD. All rights reserved.	##
##-------------------------------------------------------------##
#################################################################

define ('IN_SITE', 1);
define ('IN_AJAX', 1);

include_once('includes/global.php');

$username = $db->rem_special_chars($_GET['username']); // get the username

$count_username = $db->count_rows('users', "WHERE username='" . $username . "'");

$msg_user_un = sprintf("<img src='images/failed.jpg'  height='40' width='40'><font color='red'>%s</font>", MSG_USERNAME_UNAVAILABLE); //add by Sanzhar 15.10.2013
$msg_user_av = sprintf("<img src='images/check_green.png'><font color='green'>%s</font>", MSG_USERNAME_AVAILABLE); //add by Sanzhar 15.10.2013

if (!empty($username) && preg_match("/^[a-zA-Z0-9 ]+$/", $username)) //modified by Sanzhar 15.10.2013
{
	echo ($count_username > 0) ? $msg_user_un : $msg_user_av;
}
else 
{
	echo sprintf("<img src='images/failed.jpg'  height='40' width='40'><font color='red'>%s</font>", MSG_ENTER_USERNAME);
}
	
?>
