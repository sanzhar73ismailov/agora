<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$row_details = $db->get_sql_row("SELECT u.user_id, u.name, u.username, u.email FROM " . DB_PREFIX . "users u WHERE 
u.user_id='" . $mail_input_id . "'");
$send = true;
$text_message = 'Был создан новый аккаунт пользователя, который требует одобрения.

Детали:

- имя пользователя : %1$s
- пользователь id  : %2$s

Перейдите в Админ область -> Управление пользователями, чтобы рассмотреть и утвердить созданный аккаунт.';

$html_message = 'Был создан новый аккаунт пользователя, который требует одобрения.<br><br>
User Details:<br>
<ul><li>имя пользователя : <b>%1$s</b></li><li>пользователь id  : <b>%2$s</b></li></ul>
Перейдите в <b>Админ область</b> -> <b>Управление пользователями</b> чтобы рассмотреть и утвердить созданный аккаунт.';
$text_message = sprintf($text_message, $row_details['username'], $row_details['user_id']);
$html_message = sprintf($html_message, $row_details['username'], $row_details['user_id']);
send_mail($setts['admin_email'], $setts['sitename'] . ' - На одобрение регистрации', $text_message, 
$setts['admin_email'], $html_message, null, $send);
?>
