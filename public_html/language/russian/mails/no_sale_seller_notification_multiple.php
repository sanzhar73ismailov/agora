<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$row_details = $db->get_sql_row("SELECT u.name, u.username, u.email, u.mail_item_closed 
FROM " . DB_PREFIX . "users u WHERE u.user_id='" . $mail_input_id . "'");
$send = ($row_details['mail_item_closed']) ? true : false;
$text_message = 'Уважаемый(ая) %1$s,

Отдельные аукционы, которые Вы внесли в список, закрылись без победителя.
Или из-за отсутствия предложений, либо из-за того, что не преодолена резервная цена.

Детали аукционов можно посмотреть по ссылке:

%2$s

С уважением Администрация %3$s ';

$html_message = 'Уважаемый(ая) %1$s,<br><br>
Отдельные аукционы, которые Вы внесли в список, закрылись без победителя.<br>
Или из-за отсутствия предложений, либо из-за того, что не преодолена  резервная цена.<br><br>
[ <a href="%2$s">Ссылка</a> ] на просмотр детализации.<br><br>
С уважением Администрация %3$s ';
$items_closed_link = SITE_PATH . 'login.php?redirect=' . process_link('members_area', array('page' => 'selling', 'section' => 'closed'));
$text_message = sprintf($text_message, $row_details['name'], $items_closed_link, $setts['sitename']);
$html_message = sprintf($html_message, $row_details['name'], $items_closed_link, $setts['sitename']);
send_mail($row_details['email'], 'Аукционы закрыты', $text_message, 
$setts['admin_email'], $html_message, null, $send);
?>
