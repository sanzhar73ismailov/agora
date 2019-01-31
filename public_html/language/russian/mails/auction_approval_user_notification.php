<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$row_details = $db->get_sql_row("SELECT a.*, u.name AS user_name, u.username, u.email FROM " . DB_PREFIX . "auctions a
LEFT JOIN " . DB_PREFIX . "users u ON u.user_id=a.owner_id
WHERE a.auction_id='" . $mail_input_id . "'");
$send = true;
$text_message = 'Уважаемый(ая) %1$s,

Ваше предложение, %2$s, одобрено.

Для просмотра деталей, перейдите по ссылке ниже:
	
%3$s

С уважением, Администрация %4$s';
$html_message = 'Уважаемый(ая) %1$s, <br><br>
Ваше предложение, %2$s, одобрено.<br><br>
[ <a href="%3$s">Ссылка</a> ] для просмотра деталей.<br><br>
С уважением, Администрация %4$s';
$auction_link = process_link('auction_details', array('name' => $row_details['name'], 'auction_id' => $row_details['auction_id']));
$text_message = sprintf($text_message, $row_details['user_name'], $row_details['name'], $auction_link, $setts['sitename']);
$html_message = sprintf($html_message, $row_details['user_name'], $row_details['name'], $auction_link, $setts['sitename']);
send_mail($row_details['email'], 'Аукцион ID: ' . $row_details['auction_id'] . ' - одобрен', $text_message, 
$setts['admin_email'], $html_message, null, $send);
?>
