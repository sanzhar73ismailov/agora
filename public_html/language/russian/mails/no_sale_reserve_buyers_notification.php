<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$sql_select_auctions = $this->query("SELECT a.auction_id, a.name AS item_name,  
u.name AS buyer_name, u.username, u.email, u.mail_item_won FROM " . DB_PREFIX . "bids b
LEFT JOIN " . DB_PREFIX . "auctions a ON a.auction_id=b.auction_id
LEFT JOIN " . DB_PREFIX . "users u ON u.user_id=b.bidder_id
WHERE b.auction_id='" . $mail_input_id . "' AND b.bid_out=0 AND b.bid_invalid=0");
while ($row_details = $this->fetch_array($sql_select_auctions))
{
$send = ($row_details['mail_item_won']) ? true : false;
$text_message = 'Уважаемый(ая) %1$s,
	
Аукцион %$2s, в котором Вы участвовали, закрыт.

Победитель не определен, потому что резервная цена для аукциона не была преодолена.
	
Посмотреть детали можно по ссылке:
	
%3$s
	
И историю аукциона по ссылке:
	
%4$s
	
С уважением Администрация %5$s';
$html_message = 'Уважаемый(ая) %1$s, <br><br>
Аукцион %$2s, в котором Вы участвовали, закрыт.<br>
Победитель не определен, потому что резервная цена для аукциона не была преодолена.<br><br>
[ <a href="%3$s">Ссылка</a> ] на детализацию аукциона.<br><br>
[ <a href="%4$s">Ссылка</a> ] на историю аукциона.<br><br>
С уважением Администрация %5$s';
$bid_history_link = SITE_PATH . 'login.php?redirect=' . process_link('bid_history', array('auction_id' => $row_details['auction_id']));
$auction_link = process_link('auction_details', array('name' => $row_details['item_name'], 'auction_id' => $row_details['auction_id']));
$text_message = sprintf($text_message, $row_details['buyer_name'], $row_details['item_name'], $auction_link, $bid_history_link, $this->setts['sitename']);
$html_message = sprintf($html_message, $watch_details['buyer_name'], $watch_details['item_name'], $auction_link, $bid_history_link, $this->setts['sitename']);
send_mail($row_details['email'], 'Аукцион ID: ' . $row_details['auction_id'] . ' - Аукцион закрыт', $text_message, 
$this->setts['admin_email'], $html_message, null, $send);
}
?>
