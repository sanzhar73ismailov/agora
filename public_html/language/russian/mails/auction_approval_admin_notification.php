<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$send = true;
$text_message = 'Аукцион требующий подтверждение админа направлен почтой.

Войдите в Админ область -> Управление аукционами -> Аукционы ожидающие одобрения.';

$html_message = 'Аукцион требующий подтверждение админа направлен почтой.<br><br>
Войдите в <b>Админ область</b> -> <b>Управление аукционами</b> -> <b>Аукционы ожидающие одобрения</b>.';
send_mail($this->setts['admin_email'], 'Запрос одобрения аукциона', $text_message, 
$this->setts['admin_email'], $html_message, null, $send);
?>
