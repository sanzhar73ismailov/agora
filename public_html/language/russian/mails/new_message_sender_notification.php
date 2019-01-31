<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$msg_details = $this->get_sql_row("SELECT u.name, u.email, u.mail_messaging_sent FROM " . DB_PREFIX . "messaging m
LEFT JOIN " . DB_PREFIX . "users u ON u.user_id=m.sender_id WHERE 
m.message_id='" . $mail_input_id . "'");
$send = ($msg_details['mail_messaging_sent']) ? true : false;
$text_message = 'Уважаемый(ая) %1$s,

Вы отправили по почте новое сообщение.

Ссылка на детали сообщения:

%2$s

С увaжением Администрация %3$s ';
$html_message = 'Уважаемый(ая) %1$s, <br><br>
Вы отправили по почте новое сообщение. <br><br>
<a href="%2$s">Ссылка</a> на страницу детализации. <br><br>
С увaжением Администрация %3$s';
$msg_board_link = SITE_PATH . 'login.php?redirect=' . process_link('members_area', array('page' => 'messaging', 'section' => 'sent'));
$text_message = sprintf($text_message, $msg_details['name'], $msg_board_link, $this->setts['sitename']);
$html_message = sprintf($html_message, $msg_details['name'], $msg_board_link, $this->setts['sitename']);
send_mail($msg_details['email'], 'Послано сообщение - ' . $this->setts['sitename'], $text_message, 
$this->setts['admin_email'], $html_message, null, $send);
?>
