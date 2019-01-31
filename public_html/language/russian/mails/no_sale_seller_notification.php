<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$row_details = $db->get_sql_row("SELECT u.name, u.username, u.email, u.mail_item_closed, 
a.name AS item_name, a.currency, a.auction_id FROM " . DB_PREFIX . "auctions a 
LEFT JOIN " . DB_PREFIX . "users u ON u.user_id=a.owner_id
WHERE a.auction_id='" . $mail_input_id . "'");
$send = ($row_details['mail_item_closed']) ? true : false;
$text_message = 'Уважаемый(ая) %1$s,

Ваш аукцион, %2$s, закрыт без определения победителей.
Или из-за отсутствия предложений, либо из-за того, что не преодолена резервная цена.

Посмотреть детали можно по ссылке:

%3$s

С уважением Администрация %4$s ';

$html_message = 'Уважаемый(ая) %1$s, <br><br>
Ваш аукцион, %2$s, закрыт без определения победителей.<br>
Или из-за отсутствия предложений, либо из-за того, что не преодолена  резервная цена.<br><br>
[ <a href="%3$s">Ссылка</a> ] на детализацию аукциона.<br><br>
С уважением Администрация %4$s';
$auction_link = process_link('auction_details', array('name' => $row_details['item_name'], 'auction_id' => $row_details['auction_id']));
$text_message = sprintf($text_message, $row_details['name'], $row_details['item_name'], $auction_link, $setts['sitename']);
$html_message = sprintf($html_message, $row_details['name'], $row_details['item_name'], $auction_link, $setts['sitename']);
send_mail($row_details['email'], 'Аукцион ID: ' . $row_details['auction_id'] . ' - Аукцион закрыт', $text_message, 
$setts['admin_email'], $html_message, null, $send);
?>
