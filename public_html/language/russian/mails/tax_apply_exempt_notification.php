<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$row_details = $this->get_sql_row("SELECT u.* FROM " . DB_PREFIX . "users u 
WHERE u.user_id='" . $mail_input_id . "'");
$send = true;
$text_message = 'Новый пользователь просит освободить от налогов.

Детали по пользователю:

- Имя пользователя: %1$s
- ID пользователя : %2$s
	
Налоговый регистрационный номер: %3$s

Страница детализации ниже:

%4$s

Вы можете активизировать освобождение от налога для этого пользователя в admin области, на странице управления пользователями.';

$html_message = 'Новый пользователь просит освободить от налогов.<br><br>
Детали по пользователю: <br>
<ul><li>Имя пользователя: <b>%1$s</b></li><li>ID пользователя : <b>%2$s</b></li></ul>
Налоговый регистрационный номер: <b>%3$s</b><br><br>
Проверьте действительность Налогового регистрационного номера по, [ <a href="%4$s">Ссылка</a> ].<br><br>
Вы можете активизировать освобождение от налога для этого пользователя в <b>Админ область</b> - страница <b>Управление пользователями</b>.';

$vat_verify_link = 'http://europa.eu.int/comm/taxation_customs/vies/en/vieshome.htm';
$text_message = sprintf($text_message, $row_details['username'], $row_details['user_id'], $row_details['tax_reg_number'], $vat_verify_link);
$html_message = sprintf($html_message, $row_details['username'], $row_details['user_id'], $row_details['tax_reg_number'], $vat_verify_link);
send_mail($this->setts['admin_email'], 'Новый запрос освобождения от налогов', $text_message, 
$this->setts['admin_email'], $html_message, null, $send);
?>
