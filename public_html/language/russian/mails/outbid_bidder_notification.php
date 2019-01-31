<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$sql_select_auctions = $db->query("SELECT a.auction_id, a.name AS item_name,  
u.name AS buyer_name, u.username, u.email, u.mail_outbid FROM " . DB_PREFIX . "bids b
LEFT JOIN " . DB_PREFIX . "auctions a ON a.auction_id=b.auction_id
LEFT JOIN " . DB_PREFIX . "users u ON u.user_id=b.bidder_id
WHERE b.auction_id='" . $mail_input_id . "' AND b.bid_out=1 AND b.bid_invalid=0 AND b.email_sent=0");
$send = true;
while ($bid_details = $db->fetch_array($sql_select_auctions))
{
$text_message = 'Уважаемый(ая) %1$s,
	
Ваше предложение на, %2$s обошло другое предложение.
	
Посмотрите детализацию по ссылке:
	
%3$s
	
Посмотреть историю изменений предложений по аукциону можно по ссылке:
	
%4$s
	
С уважением Администрация %5$s ';
$html_message = 'Уважаемый(ая) %1$s,<br><br>
Ваше предложение на, %2$s обошло другое предложение.<br><br>
[ <a href="%3$s">Ссылка</a> ] на детализацию аукциона.<br><br>
[ <a href="%4$s">Ссылка</a> ] на историю предложений по аукциону.<br><br>
С уважением Администрация %5$s ';
$bid_history_link = SITE_PATH . 'login.php?redirect=' . process_link('bid_history', array('auction_id' => $bid_details['auction_id']));
$auction_link = process_link('auction_details', array('name' => $bid_details['item_name'], 'auction_id' => $bid_details['auction_id']));
$text_message = sprintf($text_message, $bid_details['buyer_name'], $bid_details['item_name'], $auction_link, $bid_history_link, $setts['sitename']);
$html_message = sprintf($html_message, $bid_details['buyer_name'], $bid_details['item_name'], $auction_link, $bid_history_link, $setts['sitename']);
send_mail($bid_details['email'], 'Аукцион ID: ' . $bid_details['auction_id'] . ' - предложение перекрыто', $text_message, 
$setts['admin_email'], $html_message, null, $send);
}
?>
