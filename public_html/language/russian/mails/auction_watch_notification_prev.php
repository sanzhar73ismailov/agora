<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$sql_select_auctions = $db->query("SELECT a.auction_id, a.name AS item_name,  
u.name AS buyer_name, u.username, u.email FROM " . DB_PREFIX . "auction_watch aw
LEFT JOIN " . DB_PREFIX . "auctions a ON a.auction_id=aw.auction_id
LEFT JOIN " . DB_PREFIX . "users u ON u.user_id=aw.user_id
WHERE aw.auction_id='" . $mail_input_id . "'");
$send = true;
while ($watch_details = $db->fetch_array($sql_select_auctions))
{
$text_message = 'Уважаемый(ая) %1$s,
	
На одном из отслеживаемых вами лотов была сделана новая ставка на аукционе, %2$s.
	
Посмотреть детали предложения можно по нижеследующей ссылке:
	
%3$s
	
Посмотреть историю предложений можно по нижеследующей ссылке:
	
%4$s
	
С уважением, Администрация %5$s';	
$html_message = 'Уважаемый(ая) %1$s, <br><br>
На одно из отслежываемых вами лотов была сделана новое ставка на аукционе, %2$s. <br><br>
[ <a href="%3$s">Ссылка</a> ] посмотреть детали.<br><br>
Посмотреть историю предложений можно [ <a href="%4$s">здесь</a> ].<br><br>
С уважением, Администрация' %5$s;
$bid_history_link = SITE_PATH . 'login.php?redirect=' . process_link('bid_history', array('auction_id' => $watch_details['auction_id']));
$auction_link = process_link('auction_details', array('name' => $watch_details['item_name'], 'auction_id' => $watch_details['auction_id']));
$text_message = sprintf($text_message, $watch_details['buyer_name'], $watch_details['item_name'], $auction_link, $bid_history_link, $setts['sitename']);
$html_message = sprintf($html_message, $watch_details['buyer_name'], $watch_details['item_name'], $auction_link, $bid_history_link, $setts['sitename']);
send_mail($watch_details['email'], 'Аукцион ID: ' . $watch_details['auction_id'] . ' - время', $text_message, 
$setts['admin_email'], $html_message, null, $send);
}
?>