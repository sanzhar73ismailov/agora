<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$row_details = $db->get_sql_row("SELECT a.*, u.name AS user_name, u.email, u.mail_confirm_to_seller FROM " . DB_PREFIX . "auctions a
LEFT JOIN " . DB_PREFIX . "users u ON u.user_id=a.owner_id WHERE a.auction_id='" . $mail_input_id . "'");
$send = ($row_details['mail_confirm_to_seller']) ? true : false;
$text_message = 'Уважаемый(ая) %1$s,

Вы разместили следующий аукцион на %2$s:

- имя       : %3$s
- тип       : %4$s
- количесиво: %5$s

- основная категория: %6$s
- дополнительнвя категория: %7$s

- цена стартовая : %8$s
- цена предельная: %9$s
- цена резерва   : %10$s

- дата закрытия: %11$s

Посмотреть детали по размещенному аукциону можно по ссылке:

%12$s

Спасибо за размещение.

С уважением Администрация %13$s';
$html_message = 'Уважаемый(ая) %1$s, <br><br>
Вы разместили следующий аукцион на <b>%2$s</b>: <br>
<ul><li>имя       : <b>%3$s</b></li><li>тип       : <b>%4$s</b></li><li>количество: <b>%5$s</b></li></ul>
<ul><li>категория основная       : <b>%6$s</b> </li><li>категория дополнительная : <b>%7$s</b> </li></ul>
<ul><li>цена стартовая : <b>%8$s</b> </li><li>цена предельная : <b>%9$s</b> </li><li>цена резерва    : <b>%10$s</b> </li></ul>
<ul><li>дата закрытия: <b>%11$s</b> </li></ul>
[ <a href="%12$s">Ссылка</a> ] на страницу детализации. <br><br>
Спасибо за размещение предложения. <br><br>
С уважением Администрация %13$s';

////// added by Sanzhar 15.04.2013
if($row_details['auction_type'] == 'standard'){
    $san_auc_type = 'Стандартный';
}elseif ($row_details['auction_type'] == 'dutch'){
    $san_auc_type = 'Голландский (оптовый)';
}else{
    $san_auc_type = 'Ошибка! Обратитесь к администратору.';
}
////////////

$main_category = category_navigator($row_details['category_id'], false, true, null, null, GMSG_NONE_CAT);
$addl_category = category_navigator($row_details['addl_category_id'], false, true, null, null, GMSG_NONE_CAT);
$start_price = $fees->display_amount($row_details['start_price'], $row_details['currency']);
$buyout_price = $fees->display_amount($row_details['buyout_price'], $row_details['currency']);
$reserve_price = $fees->display_amount($row_details['reserve_price'], $row_details['currency']);
$closing_date = show_date($row_details['end_time']);
$auction_link = process_link('auction_details', array('name' => $row_details['name'], 'auction_id' => $row_details['auction_id']));
$text_message = sprintf($text_message, $row_details['user_name'], $setts['sitename'], $row_details['name'], $san_auc_type, 
$row_details['quantity'], $main_category, $addl_category, $start_price, $buyout_price, $reserve_price, $closing_date, $auction_link, 
$setts['sitename']);
$html_message = sprintf($html_message, $row_details['user_name'], $setts['sitename'], $row_details['name'], $san_auc_type, 
$row_details['quantity'], $main_category, $addl_category, $start_price, $buyout_price, $reserve_price, $closing_date, $auction_link, 
$setts['sitename']);
send_mail($row_details['email'], 'Подтверждение размещения аукциона', $text_message, 
$setts['admin_email'], $html_message, null, $send);
?>
