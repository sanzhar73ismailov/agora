<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$sql_select_users = $db->query("SELECT u.name AS buyer_name, u.username, u.email, u.balance FROM " . DB_PREFIX . "users u WHERE 
u.balance>" . $setts['min_invoice_value']);
$send = true;
while ($row_details = $db->fetch_array($sql_select_users))
{
$text_message = 'Уважаемый(ая) %1$s,
	
Направляем счет погашения баланса на 
%2$s.

Ваш баланс: %3$s

Ниже ссылка на страницу платежей:
	
%4$s
	
С уважением, Администрация %2$s.';
$html_message = 'Уважаемый(ая) %1$s,<br><br>
Направляем счет погашения баланса на<br>
%2$s.<br><br>
Ваш баланс: <b>%3$s</b><br><br>
[ <a href="%4$s">Ссылка</a> ] на страницу платежей. <br><br>
С уважением, Администрация %2$s';
$payment_link = SITE_PATH . 'login.php?redirect=' . process_link('fee_payment', array('do' => 'clear_balance'));
$balance_amount = $fees->display_amount($row_details['balance'], $setts['currency']);
$text_message = sprintf($text_message, $row_details['buyer_name'], $setts['sitename'], $balance_amount, $payment_link);
$html_message = sprintf($html_message, $row_details['buyer_name'], $setts['sitename'], $balance_amount, $payment_link);
send_mail($row_details['email'], $setts['sitename'] . ' Счет', $text_message, 
$setts['admin_email'], $html_message, null, $send);
}
?>
