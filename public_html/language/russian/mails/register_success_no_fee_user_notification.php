<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$row_details = $db->get_sql_row("SELECT u.name, u.username, u.email FROM " . DB_PREFIX . "users u WHERE u.user_id='" . $mail_input_id . "'");
$send = true;
$text_message = 'Уважаемый(ая) %1$s,

Ваша учетная запись на %2$s успешно активирована.

Детализация:

- Логин: %3$s
- Пароль: -введенный вами пароль-

С уважением Администрация %2$s ';

$html_message = 'Уважаемый(ая) %1$s,<br><br>
Ваша учетная запись на <b>%2$s</b> успешно активирована.<br><br>
Детализация:<br>
<ul><li>Логин: <b>%3$s</b></li><li>Пароль: -введенный вами пароль-</li></ul>
С уважением Администрация %2$s ';
$text_message = sprintf($text_message, $row_details['name'], $setts['sitename'], $row_details['username']);
$html_message = sprintf($html_message, $row_details['name'], $setts['sitename'], $row_details['username']);
send_mail($row_details['email'], $setts['sitename'] . ' - Успешная регистрация', $text_message, 
$setts['admin_email'], $html_message, null, $send);
?>
