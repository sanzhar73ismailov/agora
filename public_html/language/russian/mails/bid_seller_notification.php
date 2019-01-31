<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$bid_details = $db->get_sql_row("SELECT a.*, u.name AS seller_name, u.username, u.email, u.default_bid_placed_email 
FROM " . DB_PREFIX . "auctions a 
LEFT JOIN " . DB_PREFIX . "users u ON u.user_id=a.owner_id
WHERE a.auction_id='" . $mail_input_id . "'");
$send = ($bid_details['default_bid_placed_email']) ? true : false;
$text_message = 'Уважаемый(ая) %1$s,

Новое предложение размещено на одном из ваших аукционов, %2$s.

Ссылка на подробности:

%3$s
	
С уважением, Администрация %4$s';
$html_message = 'Уважаемый(ая) %1$s, <br><br>
Новое предложение размещено на одном из ваших аукционов, %2$s.<br><br>
[ <a href="%3$s">Ссылка</a> ] на подробности.<br><br>
С уважением, Администрация %4$s';
$auction_link = process_link('auction_details', array('name' => $bid_details['name'], 'auction_id' => $bid_details['auction_id']));
$text_message = sprintf($text_message, $bid_details['seller_name'], $bid_details['name'], $auction_link, $setts['sitename']);
$html_message = sprintf($html_message, $bid_details['seller_name'], $bid_details['name'], $auction_link, $setts['sitename']);
send_mail($bid_details['email'], 'Аукцион ID: ' . $bid_details['auction_id'] . ' - размещено новое предложение', $text_message, 
$setts['admin_email'], $html_message, null, $send);
?>
