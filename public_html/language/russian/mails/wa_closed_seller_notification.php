<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$row_details = $db->get_sql_row("SELECT u.name, u.username, u.email, u.mail_item_closed, 
w.name AS item_name, w.wanted_ad_id FROM " . DB_PREFIX . "wanted_ads w
LEFT JOIN " . DB_PREFIX . "users u ON u.user_id=w.owner_id
WHERE w.wanted_ad_id='" . $mail_input_id . "'");
$send = ($row_details['mail_item_closed']) ? true : false;
$text_message = 'Уважаемый(ая) %1$s,

Срок показа Вашего объявления, %2$s, истек.

Для просмотра деталей, нажмите на URL, укаpанный ниже:

%3$s

С уважением Администрация %4$s';

$html_message = 'Уважаемый(ая) %1$s, <br><br>
Срок показа Вашего объявления, %2$s, истек<br>
[ <a href="%3$s">Ссылка</a> ] для просмотра деталей на странице.<br><br>
С уважением, <br>
Администрация %4$s';
$auction_link = process_link('wanted_details', array('wanted_ad_id' => $row_details['wanted_ad_id']));
$text_message = sprintf($text_message, $row_details['name'], $row_details['item_name'], $auction_link, $setts['sitename']);
$html_message = sprintf($html_message, $row_details['name'], $row_details['item_name'], $auction_link, $setts['sitename']);
send_mail($row_details['email'], 'Предложение ID: ' . $row_details['wanted_ad_id'] . ' - закрыто', $text_message, 
$setts['admin_email'], $html_message, null, $send);
?>
