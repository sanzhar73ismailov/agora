<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
if ($mail_input_id)
{
$row_details = $db->get_sql_row("SELECT u.user_id, u.name, u.username, u.email FROM " . DB_PREFIX . "users u WHERE 
u.user_id='" . $mail_input_id . "'");
}
$send = true;
$text_message = 'Уважаемый(ая) %1$s,

Ваша учетная запись на %2$s успешно создана.

Детализация:

- Логин  : %3$s
- Пароль : <введенный вами пароль>

Чтобы активизировать вашу учетную запись, пройдите по ссылке:

%4$s

Для указания Ваших данных (ФИО, адрес) зайдите в "Моя Агора -> Моя учетная запись -> Личная информация".
	
С уважением Администрация %2$s ';

$html_message = 'Уважаемый(ая) %1$s,<br><br>
Ваша учетная запись на <b>%2$s</b> успешно создана.<br><br>
Детализация:<br>
<ul><li>Логин  : <b>%3$s</b></li><li>Пароль : <введенный вами пароль></li></ul>
[ <a href="%4$s">Ссылка</a> ] на страницу активации учетной записи.<br><br>
Для указания Ваших данных (ФИО, адрес) зайдите в "Моя Агора -> Моя учетная запись -> Личная информация".<br><br>
С уважением Администрация %2$s ';
$activation_link = SITE_PATH . 'account_activate.php?user_id=' . $row_details['user_id'] . '&username=' . $row_details['username'];
$text_message = sprintf($text_message, $row_details['name'], $setts['sitename'], $row_details['username'], $activation_link);
$html_message = sprintf($html_message, $row_details['name'], $setts['sitename'], $row_details['username'], $activation_link);
send_mail($row_details['email'], $setts['sitename'] . ' - Подтверждение регистрации', $text_message, 
$setts['admin_email'], $html_message, null, $send);
?>
