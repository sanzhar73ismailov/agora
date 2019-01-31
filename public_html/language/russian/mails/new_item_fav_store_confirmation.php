<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$sql_select_fav_stores = $db->query("SELECT a.*, u.name AS user_name, u.email FROM " . DB_PREFIX . "favourite_stores fs,
" . DB_PREFIX . "auctions a, " . DB_PREFIX . "users u WHERE 
a.auction_id='" . $mail_input_id . "' AND a.owner_id=fs.store_id AND u.user_id=fs.user_id" );
$send = true;
while ($row_details = $db->fetch_array($sql_select_fav_stores))
{
$text_message = 'Уважаемый(ая) %1$s,

Новый аукцион размещен на одном из ваших фаворитных участков:

- имя: %3$s
- тип: %4$s
- количество: %5$s

- стартовая цена: %6$s
- верхняя цена  : %7$s
- цена резерва  : %8$s

- дата закрытия: %9$s

Посмотреть можно на следующей странице:

%10$s

С уважением Администрация %11$s';
$html_message = 'Уважаемый(ая) %1$s, <br><br>
Новый аукцион размещен на одном из ваших фаворитных участков: <br>
<ul><li>имя: <b>%3$s</b> </li><li>тип: <b>%4$s</b> </li><li>количество: <b>%5$s</b></li></ul>
<ul><li>стартовая цена: <b>%6$s</b> </li><li>верхняя цена  : <b>%7$s</b> </li><li>цена резерва  : <b>%8$s</b> </li></ul>
<ul><li>дата закрытия: <b>%9$s</b></li></ul>
[ <a href="%10$s">Ссылка</a> ] на страницу детализации. <br><br>
С уважением Администрация %11$s';
$start_price = $fees->display_amount($row_details['start_price'], $row_details['currency']);
$buyout_price = $fees->display_amount($row_details['buyout_price'], $row_details['currency']);
$reserve_price = $fees->display_amount($row_details['reserve_price'], $row_details['currency']);
$closing_date = show_date($row_details['end_time']);
$auction_link = process_link('auction_details', array('name' => $row_details['name'], 'auction_id' => $row_details['auction_id']));
$text_message = sprintf($text_message, $row_details['user_name'], $setts['sitename'], $row_details['name'], $row_details['auction_type'], 
$row_details['quantity'], $start_price, $buyout_price, $reserve_price, $closing_date, $auction_link, 
$setts['sitename']);
$html_message = sprintf($html_message, $row_details['user_name'], $setts['sitename'], $row_details['name'], $row_details['auction_type'], 
$row_details['quantity'], $start_price, $buyout_price, $reserve_price, $closing_date, $auction_link, 
$setts['sitename']);
send_mail($row_details['email'], 'Размещен новый аукцион', $text_message, 
$setts['admin_email'], $html_message, null, $send);
}
?>
