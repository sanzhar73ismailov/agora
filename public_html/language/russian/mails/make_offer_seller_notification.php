<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$offer_details = $this->get_sql_row("SELECT o.*, u.name, u.username, u.email, a.name AS item_name, a.currency FROM " . DB_PREFIX . "auction_offers o 
LEFT JOIN " . DB_PREFIX . "users u ON u.user_id=o.seller_id
LEFT JOIN " . DB_PREFIX . "auctions a ON a.auction_id=o.auction_id
WHERE o.offer_id='" . $mail_input_id . "'");
$send = true;
$text_message = 'Уважаемый(ая) %1$s,

На Вашем аукционе сделано новое предложение, %2$s.

Детали:

- цена: %3$s
- количество: %4$s
	
Посмотреть активные предложения по аукциону можно по следующей ссылке :

%5$s

C уважением Администрация %6$s';
$html_message = 'Уважаемый(ая) %1$s, <br><br>
На Вашем аукционе сделано новое предложение, %2$s. <br><br>
Детали: <br><ul><li>цена: <b>%3$s</b> </li><li>количество: <b>%4$s</b> </li></ul><br>
[ <a href="%5$s">Ссылка</a> ] на детали по аукциону. <br><br>
C уважением Администрация %6$s';
$offer_link = SITE_PATH . 'login.php?redirect=' . process_link('members_area', array('page' => 'selling', 'section' => 'view_offers', 'auction_id' => $offer_details['auction_id']));
$this->fees = new fees();
$this->fees->setts = $this->setts;
$offer_price = $this->fees->display_amount($offer_details['amount'], $offer_details['currency']);
$text_message = sprintf($text_message, $offer_details['name'], $offer_details['item_name'], $offer_price, $offer_details['quantity'], $offer_link, $this->setts['sitename']);
$html_message = sprintf($html_message, $offer_details['name'], $offer_details['item_name'], $offer_price, $offer_details['quantity'], $offer_link, $this->setts['sitename']);
send_mail($offer_details['email'], 'Аукцион ID: ' . $offer_details['auction_id'] . ' - Новое предложение', $text_message, 
$this->setts['admin_email'], $html_message, null, $send);
?>