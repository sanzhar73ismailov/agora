<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$abuse_details = $db->get_sql_row("SELECT a.*, u.username FROM " . DB_PREFIX . "abuses a 
LEFT JOIN " . DB_PREFIX . "users u ON a.user_id=u.user_id
WHERE a.abuse_id='" . $mail_input_id . "'");
$send = true;
$text_message = 'Новая жалоба о злоупотреблении была отправлена по почте %1$s на рассмотрение %2$s.

Комментарий: %3$s 

Войдите в Админ область -> Управление пользователями -> Смотреть доклад о злоупотреблении.';

$html_message = 'Новая жалоба о злоупотреблении была отправлена по почте <b>%1$s</b> на рассмотрение <b>%2$s</b>.<br><br>
Комментарий: %3$s <br><br>
Войдите в <b>Админ область</b> -> <b>Управление пользователями</b> -> <b>Смотреть жалобу о злоупотреблении</b>.';
$text_message = sprintf($text_message, $abuse_details['username'], $abuse_details['abuser_username'], $abuse_details['comment']);
$html_message = sprintf($html_message, $abuse_details['username'], $abuse_details['abuser_username'], $abuse_details['comment']);
send_mail($setts['admin_email'], 'Уведомление о злоупотреблении - #' . $abuse_details['abuse_id'], $text_message, 
$setts['admin_email'], $html_message, null, $send);
?>
