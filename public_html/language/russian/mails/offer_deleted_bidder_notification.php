<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$bidder_row = ($offer_table == 'bids') ? 'bidder_id' : 'buyer_id';
$row_details = $this->get_sql_row("SELECT a.*, u.name AS user_name, u.email FROM 
" . DB_PREFIX . $offer_table . " o
LEFT JOIN " . DB_PREFIX . "auctions a ON a.auction_id=o.auction_id 
LEFT JOIN " . DB_PREFIX . "users u ON u.user_id=o." . $bidder_row . " WHERE
o." . $offer_id_name . "='" . $offer_id . "' AND a.owner_id='" . $user_id . "'");
$send = true;
$text_message = 'Уважаемый(ая) %1$s,

%2$s предложение сделанное вами на %3$s удалено продавцом.

Ссылка на детализацию аукциона:
	
%4$s

С уважением Администрация %5$s ';

$html_message = 'Уважаемый(ая) %1$s,<br><br>
%2$s предложение сделанное вами на %3$s удалено продавцом.<br><br>
[ <a href="%4$s">Ссылка</a> ] на детализацию информации по аукциону.<br><br>
С уважением Администрация %5$s ';
$offer_type = ($offer_table == 'bids') ? 'reserve' : 'fixed price';
$offer_type = ($offer_table == 'swaps') ? 'swap' : $offer_type;
$auction_link = process_link('auction_details', array('name' => $row_details['name'], 'auction_id' => $row_details['auction_id']));
$text_message = sprintf($text_message, $row_details['user_name'], $offer_type, $row_details['name'], $auction_link, $this->setts['sitename']);
$html_message = sprintf($html_message, $row_details['user_name'], $offer_type, $row_details['name'], $auction_link, $this->setts['sitename']);
send_mail($row_details['email'], 'Аукцион ID: ' . $offer_details['auction_id'] . ' - предложение отклонено', $text_message, 
$this->setts['admin_email'], $html_message, null, $send);
?>
