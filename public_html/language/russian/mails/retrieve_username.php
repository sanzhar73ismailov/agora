<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$row_details = $db->get_sql_row("SELECT u.username, u.email FROM " . DB_PREFIX . "users u WHERE u.email='" . $mail_input_id . "'");
$send = true;
$text_message = 'Дорогой подписчик,

Ваш login на %1$s - : %2$s

С уважением Администрация %1$s ';

$html_message = 'Дорогой подписчик %1$s,<br><br>
Ваше login на %1$s - : <b>%2$s</b><br><br>
С уважением Администрация %1$s ';
$text_message = sprintf($text_message, $setts['sitename'], $row_details['username']);
$html_message = sprintf($html_message, $setts['sitename'], $row_details['username']);
send_mail($row_details['email'], $setts['sitename'] . ' - Логин восстановлен', $text_message, 
$setts['admin_email'], $html_message, null, $send);
?>
