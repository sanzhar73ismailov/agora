<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$row_details = $db->get_sql_row("SELECT u.name, u.username, u.email FROM " . DB_PREFIX . "users u WHERE u.username='" . $mail_input_id . "'");
$send = true;
$text_message = 'Уважаемый(ая) %1$s,

Ваш пароль на %2$s успешно изменен.

Детализация:

- Логин  : %3$s
- Пароль : %4$s

С уважением Администрация %2$s ';

$html_message = 'Уважаемый(ая) %1$s,<br><br>
Ваш пароль на <b>%2$s</b> успешно изменен.<br><br>
Детализация:<br>
<ul><li>Логин  : <b>%3$s</b></li><li>Пароль : <b>%4$s</b></li></ul>
С уважением Администрация %2$s ';
$text_message = sprintf($text_message, $row_details['name'], $setts['sitename'], $row_details['username'], $new_password);
$html_message = sprintf($html_message, $row_details['name'], $setts['sitename'], $row_details['username'], $new_password);
send_mail($row_details['email'], $setts['sitename'] . ' - Восстановление деталей аккаунта', $text_message, 
$setts['admin_email'], $html_message, null, $send);
?>
