<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$sale_details = $this->get_sql_row("SELECT w.*, u.name, u.username, u.email, u.mail_item_won, 
a.name AS item_name, a.currency, wu.username AS seller_name FROM " . DB_PREFIX . "winners w 
LEFT JOIN " . DB_PREFIX . "users u ON u.user_id=w.buyer_id
LEFT JOIN " . DB_PREFIX . "auctions a ON a.auction_id=w.auction_id
LEFT JOIN " . DB_PREFIX . "users wu ON wu.user_id=w.seller_id
WHERE w.winner_id='" . $mail_input_id . "'");
$send = ($sale_details['mail_item_won']) ? true : false;
$text_message = 'Уважаемый(ая) %1$s,

Вы успешно купили %2$s.

Детали покупки:

	- цена         : %3$s
	- количество   : %4$s
	- url аукциона : %7$s
	- продавец     : %8$s
	
Для ознакомления с деталями, перейдите по ссылке :  

%5$s

После посещения предыдущей страницы, откройте "Доску Сообщений " по ссылке, рядом с каждым пунктом.
Доска сообщений предназначена для прямой связи с продавцом.
Используйте ее по всем возникающим вопросам.

С уважением Администрация %6$s ';

$html_message = 'Уважаемый(ая) %1$s,<br><br>
Вы успешно купили %2$s.<br><br>
Детали покупки:<br>
<ul>
<li>цена         : <b>%3$s</b></li>
<li>количество   : <b>%4$s</b></li>
<li>url аукциона : [ <a href="%7$s">Ссылка</a> ]</li>
<li>продавец     : <b>%8$s</b></li>
</ul>
Для большей детализации перейдите по [ <a href="%5$s">Ссылке</a> ].<br><br>
После посещения предыдущей страницы, откройте "Доску Сообщений " по ссылке, рядом с каждым пунктом.<br>
Доска сообщений предназначена для прямой связи с продавцом.
Используйте ее по всем возникающим вопросам.<br><br>
С уважением Администрация %6$s';
$items_won_link = SITE_PATH . 'login.php?redirect=' . process_link('members_area', array('page' => 'bidding', 'section' => 'won_items'));
$auction_link = process_link('auction_details', array('name' => $sale_details['item_name'], 'auction_id' => $sale_details['auction_id']));
$this->fees = new fees();
$this->fees->setts = $this->setts;
$sale_price = $this->fees->display_amount($sale_details['bid_amount'], $sale_details['currency']);
$text_message = sprintf($text_message, $sale_details['name'], $sale_details['item_name'], $sale_price, $sale_details['quantity_offered'], $items_won_link, $this->setts['sitename'], $auction_link, $sale_details['seller_name']);
$html_message = sprintf($html_message, $sale_details['name'], $sale_details['item_name'], $sale_price, $sale_details['quantity_offered'], $items_won_link, $this->setts['sitename'], $auction_link, $sale_details['seller_name']);
send_mail($sale_details['email'], 'Аукцион ID: ' . $sale_details['auction_id'] . ' - Успешная покупка', $text_message, 
$this->setts['admin_email'], $html_message, null, $send);
?>
