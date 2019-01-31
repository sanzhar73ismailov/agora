<?
## File Version -> v6.06
## Email File -> notify seller that a bidder has retracted his bids on an auction
## called only from the item->retract_bid() function!


if (! defined ( 'INCLUDED' )) {
	die ( "Access Denied" );
}

$bid_details = $this->get_sql_row ( "SELECT a.auction_id, a.name, u.name AS user_name, u.email FROM " . DB_PREFIX . "auctions a 
	LEFT JOIN " . DB_PREFIX . "users u ON u.user_id=a.owner_id WHERE 
	a.auction_id='" . $auction_id . "'" );

$send = true;

## text message - editable
$text_message = 'Уважаемый(ая) %1$s,
	
Пользователь отозвал все свои ставки на одном из ваших аукционов, %2$s.
	
Для просмотра страницы деталей аукциона, перейдите по ссылке:
	
%3$s
	
Для просмотра истории ставок этого аукциона щелкните сюда:
	
%4$s
		
С уважением,
Администрация %5$s';

## html message - editable
$html_message = 'Уважаемый(ая) %1$s, <br>
<br>
Пользователь отозвал все свои ставки на одном из ваших аукционов, %2$s. <br>
<br>
[ <a href="%3$s">Щелкните сюда</a> ] для просмотра страницы деталей аукциона. <br>
[ <a href="%4$s">Щелкните сюда</a> ]  для просмотра истории ставок этого аукциона. <br>
 
<br>
С уважением, <br>
Администрация  %5$s';

$auction_link = process_link ( 'auction_details', array ('auction_id' => $bid_details ['auction_id'] ) );
$bids_link = process_link ( 'bid_history', array ('auction_id' => $bid_details ['auction_id'] ) );

$text_message = sprintf ( $text_message, $bid_details ['user_name'], $bid_details ['name'], $auction_link, $bids_link, $this->setts ['sitename'] );
$html_message = sprintf ( $html_message, $bid_details ['user_name'], $bid_details ['name'], $auction_link, $bids_link, $this->setts ['sitename'] );

send_mail ( $bid_details ['email'], 'Auction ID: ' . $bid_details ['auction_id'] . ' - Bid(s) Retracted', $text_message, $this->setts ['admin_email'], $html_message, null, $send );
?>
