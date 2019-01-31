<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$send = true;
$text_message = 'Новое сообщение прислано от

Детали:

- Имя: %1$s
- email: %2$s
- Логин (не обязательно): %3$s
	
Вопрос:

%4$s';

$html_message = 'Новое сообщение прислано от<br><br>
Детали: <br><ul><li>Имя: <b>%1$s</b></li><li>Email: <b>%2$s</b></li><li>Логин (не обязательно): <b>%3$s</b></li></ul>
Вопрос:<br><br>%4$s';
$text_message = sprintf($text_message, $user_details['name'], $user_details['email'], $user_details['username'], $user_details['question_content']);
$html_message = sprintf($html_message, $user_details['name'], $user_details['email'], $user_details['username'], $user_details['question_content']);
send_mail($setts['admin_email'], $setts['sitename'] . ' - Новое сообщение', $text_message, 
$setts['admin_email'], $html_message, null, $send);
?>
