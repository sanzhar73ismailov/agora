<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$row_details = $db->get_sql_row("SELECT u.name AS buyer_name, u.username, u.email, u.balance FROM " . DB_PREFIX . "users u WHERE
u.user_id=" . $mail_input_id);
$send = true;
$text_message = 'Уважаемый(ая) %1$s,
	
Ваша учетная запись %2$s была приостановлена в связи с превышение разрешенного максимального лимита.

Ваш баланс: %3$s

Для активации учетной записи, вы должны погасить баланс. 
Перейдите на страницу платежей:
	
%4$s
	
С уважением, %2$s Администрация';
$html_message = 'Уважаемый(ая) %1$s,<br><br>
Ваш учетная запись %2$s была приостановлена в связи с превышение разрешенного максимального лимита.<br><br>
Ваш баланс: <b>%3$s</b> <br><br>
Для активации учетной записи, вы должны погасить баланс. <br>
[ <a href="%4$s">Ссылка</a> ] на страницу платежей. <br><br>
С уважением, Администрация %2$s';
$payment_link = SITE_PATH . 'login.php?redirect=' . process_link('fee_payment', array('do' => 'clear_balance'));
$balance_amount = $fees->display_amount($row_details['balance'], $setts['currency']);
$text_message = sprintf($text_message, $row_details['buyer_name'], $setts['sitename'], $balance_amount, $payment_link);
$html_message = sprintf($html_message, $row_details['buyer_name'], $setts['sitename'], $balance_amount, $payment_link);
send_mail($row_details['email'], $setts['sitename'] . ' - Аккаунт приостановлен', $text_message,
$setts['admin_email'], $html_message, null, $send);
?>
