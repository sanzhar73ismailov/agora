<?
## File Version -> v6.10b
## Email File -> notify store owners that their subscription is about to expire.
## Called only from the main_cron.php page!


if (! defined ( 'INCLUDED' )) {
	die ( "Access Denied" );
}

$shop_expiration_date = intval ( $shop_expiration_date );
$shop_exp_date_days = intval ( $shop_exp_date_days );

$sql_select_users = $db->query ( "SELECT user_id, name, username, email FROM " . DB_PREFIX . "users u 
	WHERE shop_active=1 AND shop_account_id>0 AND 
	shop_next_payment>0 AND shop_next_payment<" . $shop_expiration_date . " AND store_expiration_email=0" );

$send = true; ## always send


## send to all the winners of the auction for which the bank details have been set/changed
while ( $row_details = $db->fetch_array ( $sql_select_users ) ) {
	## text message - editable
	$text_message = 'Уважаемый(ая) %1$s,
	
Срок вашей подписки на пользование магазином на %2$s истечет через %3$s дней (дня). 

Пожалуйста, для возобновления подписки щелкните на ссылку ниже:
%4$s

Пож-та, помните, что вы должны сначала войти в Моя Агора.

%5$s

С уважением,
Администрация %2$s';
	
	## html message - editable
	$html_message = 'Уважаемый(ая) %1$s,<br>
<br>
Срок вашей подписки на пользование магазином на <b>%2$s</b> истечет через %3$s дней (дня).<br>
<br>
Пожалуйста, [ <a href="%4$s">щелкните сюда</a> ] для возобновления подписки. <br>
<br>
Пож-та, помните, что вы должны сначала войти в Моя Агора.<br>
<br>
%5$s<br>
<br>
С уважением, <br>
Администрация %2$s';
	
	$payment_link = SITE_PATH . 'login.php?redirect=' . process_link ( 'fee_payment', array ('do' => 'store_subscription_payment' ) );
	
	$user_payment_mode = $fees->user_payment_mode ( $row_details ['user_id'] );
	$account_mode_note = ($user_payment_mode == 2) ? 'Примечание: Ваш счет будет выставлен автоматически, когда истечет подписка на магазин.' : '';
	
	$text_message = sprintf ( $text_message, $row_details ['name'], $setts ['sitename'], $shop_exp_date_days, $payment_link, $account_mode_note );
	$html_message = sprintf ( $html_message, $row_details ['name'], $setts ['sitename'], $shop_exp_date_days, $payment_link, $account_mode_note );
	
	//commented by Sanzhar 26 Sept 2014 убрал до тех пор пока подписка на магазины не станет платная
	//uncommented by Sanzhar 28 Sept 2014 - для тестирования снова разкомментил
	send_mail ( $row_details ['email'], $setts ['sitename'] . ' Cрок подписки на пользование магазином истекает', $text_message, $setts ['admin_email'], $html_message, null, $send );
	
	$db->query ( "UPDATE " . DB_PREFIX . "users SET store_expiration_email=1 WHERE user_id='" . $row_details ['user_id'] . "'" );
	
	//add by Sanzhar 04 Apr 2013
	/*
	$sanzhar_mail = 'sanzhar73@mail.ru';
	send_mail ( $sanzhar_mail, $setts ['sitename'] . ' Истечение срока магазина' . ', sent to ' . $row_details ['email'] . ' MUST BE TRANSLATED! file name: ' . __FILE__, $text_message, $setts ['admin_email'], $html_message, null, $send );
	*/
}
?>
