<?

if (!defined('INCLUDED')) {
    die("Access Denied");
}
$sale_details = $this->get_sql_row("SELECT w.*, w.winner_id AS wid, w.buyout_purchase AS wbuyout_purchase,wu.email AS wuemail, wu.phone AS wuphone,
    u.name, u.username, u.email, u.mail_item_sold, 
a.name AS item_name, a.currency, a.start_time, a.end_time, a.max_bid, a.postage_amount, a.type_service, a.quantity, a.shipping_details, 
wu.username AS winner_name FROM " . DB_PREFIX . "winners w 
LEFT JOIN " . DB_PREFIX . "users u ON u.user_id=w.seller_id
LEFT JOIN " . DB_PREFIX . "auctions a ON a.auction_id=w.auction_id
LEFT JOIN " . DB_PREFIX . "users wu ON wu.user_id=w.buyer_id
WHERE w.winner_id='" . $mail_input_id . "'");



$send = ($sale_details ['mail_item_sold']) ? true : false;

$text_message = 'Уважаемый(ая) %1$s,
Ваш аукцион успешно продан.

Для связи с покупателем используйте 

Детали продажи:
Название (ID): %2$s (ID: %3$s).
Время начала: %4$s.
Время завершения: %5$s.
Конечная цена: %6$s.
Условия доставки: %7$s.
Вид доставки (чем): %8$s.
Информация о доставке и оплате: %9$s.

Покупатель:
Количество в заявке: %10$s.
Купленное количество: %11$s.
Цена: %6$s.
Подробнее о доставке: %12$s.
Покупатель:  %13$s. (%14$s).
Контактный телефон: %15$s.

Чтобы задать вопрос продавцу через доску сообщений нажмите <a href="%16$s">сюда</a><br/>
Чтобы написать письмо покупателю, нажмите на этот адрес %14$s.
Страница аукциона : %17$s
Для просмотра списка проданных товаров перейдите по ссылке %18$s.
После посещения этой страницы, откройте "Доску Сообщений " по ссылке, рядом с каждым пунктом (Ориентируйтесь по названию и ID лота).
Доска сообщений предназначена для прямой связи с покупателем. Используйте ее по всем возникшим вопросам.
Не отвечайте по данному электронному адресу, в данном случае он используется только для отправки письма! Чтобы написать письмо покупателю, нажмите на этот адрес %14$s

С уважением Администрация %19$s';

/*
$html_message = 'Уважаемый(ая) %1$s,<br><br>
Ваш аукцион, %2$s <b>(ID %10$s)</b>, успешно продан.<br><br>
Детали продажи: <br>
<ul>
<li>цена         : <b>%3$s</b> </li>
<li>количество   : <b>%4$s</b> </li>
<li>url аукциона : [ <a href="%7$s">Ссылка</a> ] </li>
<li>покупатель   : <b>%8$s</b> </li>
</ul>
Для детализации перейдите по [ <a href="%5$s">Ссылке</a> ].<br><br>
После посещения предыдущей страницы, откройте "Доску Сообщений " по ссылке, рядом с каждым пунктом.<br>
Доска сообщений предназначена для прямой связи с покупателем.<br>
Используйте ее по всем возникающим вопросам.<br><br>
Чтобы сразу попасть на "Доску сообщений" по этому лоту нажмите на [ <a href="%9$s">Cсылку</a> ].<br>
С уважением Администрация %6$s';
*/
$html_message = '
<div style="color:red">Не отвечайте по данному электронному адресу, в данном случае он используется только для отправки письма!</div><p/>
Уважаемый(ая) %1$s,<br><br>
Ваш аукцион успешно продан.<br><br>
<p>
<b>Детали продажи:</b> <br>
<table border="1">
<tr><td style="BACKGROUND: #eeeeee;">Название (ID)</td><td>%2$s (ID: %3$s)</td></tr>
<tr><td style="BACKGROUND: #eeeeee;">Время начала</td><td>%4$s</td></tr>
<tr><td style="BACKGROUND: #eeeeee;">Время завершения</td><td>%5$s</td></tr>
<tr><td style="BACKGROUND: #eeeeee;">Конечная цена</td><td>%6$s</td></tr>
<tr><td style="BACKGROUND: #eeeeee;">Условия доставки</td><td>%7$s</td></tr>
<tr><td style="BACKGROUND: #eeeeee;">Вид доставки (чем)</td><td>%8$s</td></tr>
<tr><td style="BACKGROUND: #eeeeee;">Информация о доставке и оплате</td><td>%9$s</td></tr>
</table>
<p>
<b>Покупатель:</b><br>
<table  border="1">
<tr style="BACKGROUND: #eeeeee;">
<td>Количество в заявке</td>
<td>Купленное количество</td>
<td>Цена</td>
<td>Подробнее о доставке</td>
<td>Покупатель</td>
<td>Контактный телефон</td>
</tr>
<tr>
<td>%10$s</td>
<td>%11$s</td>
<td>%6$s</td>
<td>%12$s</td>
<td>%13$s<br><br>%14$s</td>
<td>%15$s</td>
</tr>
</table>
<p>
Чтобы задать вопрос покупателю через доску сообщений нажмите <a href="%16$s">сюда</a><br/>
Чтобы написать письмо покупателю, нажмите на этот адрес %14$s.<br/>

Страница аукциона : [ <a href="%17$s">Ссылка</a> ] <br>
Для просмотра списка проданных товаров перейдите по [ <a href="%18$s">Ссылке</a> ].<br>
После посещения этой страницы, откройте "Доску Сообщений " по ссылке, рядом с каждым пунктом (Ориентируйтесь по названию и ID лота).<br>
Доска сообщений предназначена для прямой связи с покупателем. Используйте ее по всем возникшим вопросам.<br><br>
<div style="color:red">Не отвечайте по данному электронному адресу, в данном случае он используется только для отправки письма! Чтобы написать письмо покупателю, нажмите на этот адрес %14$s</div>

С уважением Администрация %19$s';

// is->fees = new fees ();
$this->fees->setts = $this->setts;
$sale_price = $this->fees->display_amount($sale_details ['bid_amount'], $sale_details ['currency']);
$items_sold_link = SITE_PATH . 'login.php?redirect=' . process_link('members_area', array(
            'page' => 'selling',
            'section' => 'sold'
        ));
$auction_link = process_link('auction_details', array(
    'name' => $sale_details ['item_name'],
    'auction_id' => $sale_details ['auction_id']
        ));

$message_board_link = SITE_PATH . 'login.php?redirect=' . process_link('message_board', array(
            'message_handle' => '3',
            'winner_id' => $sale_details ['wid']
        ));
$user_reputation_link = SITE_PATH . 'login.php?redirect=' . process_link('user_reputation', array('user_id' => $sale_details['buyer_id']));

$s_var01_seller_name = $sale_details ['name'];
$s_var02_item_name = $sale_details ['item_name'];
$s_var03_auction_id = $sale_details ['auction_id'];
$s_var04_auction_start_time = show_date($sale_details['start_time']);
$s_var05_auction_end_time = show_date($sale_details['end_time']);
$s_var06_item_price_final = $sale_price . ($sale_details['wbuyout_purchase'] == 1 ? " (" . MSG_BUY_OUT_ITEM . ")" : "");
$s_var07_cost_delivery = (($sale_details['shipping_method'] == 1) ? MSG_BUYER_PAYS_SHIPPING : MSG_SELLER_PAYS_SHIPPING) .
        ". " . MSG_POSTAGE . ": " . $sale_details['postage_amount'] . " " . $sale_details['currency'];
$s_var08_delivery_by = $sale_details['type_service'];
$s_var09_terms_payment = $sale_details['shipping_details'];
$s_var10_number_in_bid = $sale_details['quantity'] + $sale_details['quantity_offered'];
$s_var11_number_purchased = $sale_details['quantity_offered'];
$s_var12_delivery_details = $sale_details['shipping_details'];

$s_var13_buyer_ref = '<a href="' . $user_reputation_link . '">' . $sale_details['winner_name'] . " (cм.репутацию)" . '</a>';

$s_var14_buyer_email = $sale_details['wuemail'];
$s_var15_buyer_phone = $sale_details['wuphone'];
$s_var16_message_board_link = $message_board_link;
$s_var17_auction_link = $auction_link;
$s_var18_list_selles_auctions = $items_sold_link;
$s_var19_site_name = $this->setts ['sitename'];

$text_message = sprintf($text_message, $s_var01_seller_name, $s_var02_item_name, $s_var03_auction_id, $s_var04_auction_start_time, $s_var05_auction_end_time, $s_var06_item_price_final, $s_var07_cost_delivery, $s_var08_delivery_by, $s_var09_terms_payment, $s_var10_number_in_bid, $s_var11_number_purchased, $s_var12_delivery_details, $s_var13_buyer_ref, $s_var14_buyer_email, $s_var15_buyer_phone, $s_var16_message_board_link, $s_var17_auction_link, $s_var18_list_selles_auctions, $s_var19_site_name);
$html_message = sprintf($html_message, $s_var01_seller_name, $s_var02_item_name, $s_var03_auction_id, $s_var04_auction_start_time, $s_var05_auction_end_time, $s_var06_item_price_final, $s_var07_cost_delivery, $s_var08_delivery_by, $s_var09_terms_payment, $s_var10_number_in_bid, $s_var11_number_purchased, $s_var12_delivery_details, $s_var13_buyer_ref, $s_var14_buyer_email, $s_var15_buyer_phone, $s_var16_message_board_link, $s_var17_auction_link, $s_var18_list_selles_auctions, $s_var19_site_name);




send_mail($sale_details ['email'], 'Аукцион ID: ' . $sale_details ['auction_id'] . ' - Успешная продажа', $text_message, $this->setts ['admin_email'], $html_message, null, $send);
?>
