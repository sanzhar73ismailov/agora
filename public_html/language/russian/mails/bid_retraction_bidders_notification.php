<?
## File Version -> v6.04
## Email File -> notify remaining bidders that a user has retracted his bids on an auction
## called only from the item->retract_bid() function!

if ( !defined('INCLUDED') ) { die("Access Denied"); }

$sql_select_bids = $this->query("SELECT b.auction_id, a.name, u.name AS user_name, u.email FROM " . DB_PREFIX . "bids b 
	LEFT JOIN " . DB_PREFIX . "auctions a ON a.auction_id=b.auction_id 
	LEFT JOIN " . DB_PREFIX . "users u ON u.user_id=b.bidder_id WHERE 
	b.auction_id='" . $auction_id . "' AND b.bid_invalid=0 GROUP BY b.bidder_id");

$send = true;

while ($bid_details = $this->fetch_array($sql_select_bids))
{
	## text message - editable
	$text_message = 'Уважаемый(ая) %1$s,
	
	Пользователь отменил свои предложения по аукциону, в которым Вы тоже сделали ставку, %2$s.
	
	Посмотреть детали по данному лоту можно по ссылке:
	
	%3$s
	
	Историю ставок на лот по ссылке:
	
	%4$s
		
	С уважением,
	Администрация %5$s ';
	
	## html message - editable
	$html_message = 'Уважаемый(ая) %1$s, <br>
	<br>
	Пользователь отменил свои предложения по аукциону, в которым Вы тоже сделали ставку, %2$s.<br>
	<br>
	[ <a href="%3$s">Ссылка</a> ] на детализацию аукциона.<br><br>
	[ <a href="%4$s">Ссылка</a> ] на историю ставок по аукциону.<br><br>
	<br>
	С уважением,<br>
	Администрация %5$s';
	
	
	
	$auction_link = process_link('auction_details', array('auction_id' => $bid_details['auction_id']));
	$bids_link = process_link('bid_history', array('auction_id' => $bid_details['auction_id']));
	
	$text_message = sprintf($text_message, $bid_details['user_name'], $bid_details['name'], $auction_link, $bids_link, $this->setts['sitename']);
	$html_message = sprintf($html_message, $bid_details['user_name'], $bid_details['name'], $auction_link, $bids_link, $this->setts['sitename']);
	
	send_mail($bid_details['email'], 'Auction ID: ' . $bid_details['auction_id'] . ' - Bid(s) Retracted', $text_message, 
		$this->setts['admin_email'], $html_message, null, $send);
}
?>
