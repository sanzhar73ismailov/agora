<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$row_details = $db->get_sql_row("SELECT u.name AS buyer_name, u.username, u.email, u.balance FROM " . DB_PREFIX . "users u WHERE 
u.user_id='" . $mail_input_id . "'");
$send = true;
$text_message = 'Уважаемый(ая) %1$s,

Это - счет на клиринг вашего баланса на сайте,
%2$s.

Ваш баланс: %3$s

Перейдите по ссылке на страницу платежей :
	
%4$s
	
Не забудьте, что сначала нужно зарегистрироваться.

С уважением,
 Администрация %2$s';
$html_message = 'Уважаемый(ая) %1$s,<br>
<br>
Это - счет на клиринг вашего баланса на сайте, <br>
%2$s.<br><br>
Ваш баланс: <b>%3$s</b> <br><br>
Перейдите по [ <a href="%4$s">ссылке</a> ] на страницу платежей. <br><br>
Не забудьте, что сначала нужно зарегистрироваться.<br><br>
С уважением, <br>
 Администрация %2$s';
$payment_link = SITE_PATH . 'login.php?redirect=' . process_link('fee_payment', array('do' => 'clear_balance'));
$balance_amount = $fees->display_amount($row_details['balance'], $setts['currency']);
$text_message = sprintf($text_message, $row_details['buyer_name'], $setts['sitename'], $balance_amount, $payment_link);
$html_message = sprintf($html_message, $row_details['buyer_name'], $setts['sitename'], $balance_amount, $payment_link);
send_mail($row_details['email'], $setts['sitename'] . ' Счет', $text_message, 
$setts['admin_email'], $html_message, null, $send);
?>
