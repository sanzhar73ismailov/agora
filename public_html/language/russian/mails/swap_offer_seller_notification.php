<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$offer_details = $this->get_sql_row("SELECT s.*, u.name, u.username, u.email, a.name AS item_name, a.currency FROM " . DB_PREFIX . "swaps s 
LEFT JOIN " . DB_PREFIX . "users u ON u.user_id=s.seller_id
LEFT JOIN " . DB_PREFIX . "auctions a ON a.auction_id=s.auction_id
WHERE s.swap_id='" . $mail_input_id . "'");
$send = true;
$text_message = 'Уважаемый(ая) %1$s,

Новое предложение обмена было сделано на вашем аукционе, %2$s.

Детали:

- запрошенное количество: %3$s
	
- предложено к обмену: %4$s
	
Ссылка на страницу детализации ниже:

%5$s

С уважением Администрация %6$s';

$html_message = 'Уважаемый(ая) %1$s,<br><br>
Новое предложение обмена было сделано на вашем аукционе.<br><br>
Детали: <br>
<ul><li>запрошенное количество: <b>%3$s</b> </li><li>предложено к обмену: %4$s </li></ul><br>
[ <a href="%5$s">Ссылка</a> ] на страницу просмотра деталей.<br><br>
С уважением Администрация %6$s';
$offer_link = SITE_PATH . 'login.php?redirect=' . process_link('members_area', array('page' => 'selling', 'section' => 'view_offers', 'auction_id' => $offer_details['auction_id']));
$text_message = sprintf($text_message, $offer_details['name'], $offer_details['item_name'], $offer_details['quantity'], $offer_details['description'], $offer_link, $this->setts['sitename']);
$html_message = sprintf($html_message, $offer_details['name'], $offer_details['item_name'], $offer_details['quantity'], $offer_details['description'], $offer_link, $this->setts['sitename']);
send_mail($offer_details['email'], 'Аукцион ID: ' . $offer_details['auction_id'] . ' - Новое предложение обмена', $text_message, 
$this->setts['admin_email'], $html_message, null, $send);
?>
