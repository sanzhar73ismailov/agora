<?
## File Version -> v6.07
## Email File -> notify users that one or more of their auctions has been suspended by the admin
## called from admin/list_auctions.php

if ( !defined('INCLUDED') ) { die("Access Denied"); }

$sql_select_auctions = $db->query("SELECT a.auction_id, a.owner_id, u.name AS buyer_name, u.username, u.email, u.balance 
	FROM " . DB_PREFIX . "auctions a
	LEFT JOIN " . DB_PREFIX . "users u ON u.user_id=a.owner_id 	
 	WHERE a.auction_id IN (" . $mail_input_id . ") 
 	GROUP BY a.owner_id");

$send = true; ## always send

while ($row_details = $db->fetch_array($sql_select_auctions))
{
	## text message - editable
	$text_message = 'Уважаемый(ая) %1$s,
	
Один или несколько лотов, размещенных Вами на %2$s были приостановлены администратором.

Причина: 
%3$s.

Если у Вас есть вопросы по этому поводу, можете связаться с нами.
	
С уважением,
Администрация %2$s';
	
	## html message - editable
	$html_message = 'Уважаемый(ая) %1$s, <br>
<br>
Один или несколько лотов, размещенных Вами на %2$s были приостановлены администратором. <br>
<br>
Причина: <br>
%3$s. <br>
<br>
Если у Вас есть вопросы по этому поводу, можете связаться с нами. <br>
<br>
С уважением, <br>
Администрация %2$s';
	
	$suspension_reason = (empty($suspension_reason)) ? GMSG_NA : $suspension_reason;
	
	$text_message = sprintf($text_message, $row_details['buyer_name'], $setts['sitename'], $suspension_reason);
	$html_message = sprintf($html_message, $row_details['buyer_name'], $setts['sitename'], $suspension_reason);
	
	send_mail($row_details['email'], $setts['sitename'] . ' - Auction(s) Suspended', $text_message, 
		$setts['admin_email'], $html_message, null, $send);
}
?>