<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$sql_select_auctions = $db->query("SELECT u.name, u.username, u.email, u.mail_confirm_to_seller FROM " . DB_PREFIX . "auctions a 
LEFT JOIN " . DB_PREFIX . "users u ON a.owner_id=u.user_id WHERE 
a.is_relisted_item=1 AND a.notif_item_relisted=0 GROUP BY a.owner_id");
while ($row_details = $db->fetch_array($sql_select_auctions))
{
$send = ($row_details['mail_confirm_to_seller']) ? true : false;
$text_message = 'Уважаемый(ая) %1$s,

Некоторые аукционы из вашего списка на %2$s обновились.

Для просмотра деталей, перейдите по ссылке:

%3$s

С уважением Администрация %2$s';

$html_message = 'Уважаемый(ая) %1$s,<br><br>
Некоторые аукционы из вашего списка на %2$s обновились.<br><br>
[ <a href="%3$s">Ссылка</a> ] на просмотр страницы деталей.<br><br>
С уважением Администрация %2$s';
$items_open_link = SITE_PATH . 'login.php?redirect=' . process_link('members_area', array('page' => 'selling', 'section' => 'open'));
$text_message = sprintf($text_message, $row_details['name'], $setts['sitename'], $items_open_link);
$html_message = sprintf($html_message, $row_details['name'], $setts['sitename'], $items_open_link);
send_mail($row_details['email'], 'Обновление аукционов', $text_message, 
$setts['admin_email'], $html_message, null, $send);
}
?>
