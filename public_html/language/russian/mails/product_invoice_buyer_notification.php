<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$row_details = $this->get_sql_row("SELECT u.name, u.email, w.invoice_id FROM " . DB_PREFIX . "winners w 
LEFT JOIN " . DB_PREFIX . "users u on u.user_id=w.buyer_id WHERE 
w.invoice_id='" . $mail_input_id . "'");
$send = true;
$text_message = 'Уважаемый(ая) %1$s,
	
Счет был выписан продавцом изделий, которые Вы у него купили.
	
Посмотрите по ссылке детали:
	
%2$s
		
С уважением Администрация %3$s ';

$html_message = 'Уважаемый(ая) %1$s,<br><br>
Счет был выписан продавцом изделий, которые Вы у него купили.<br><br>
[ <a href="%2$s">Ссылка</a> ] на просмотр детализации.<br><br>
С уважением Администрация %3$s ';
$invoice_link = SITE_PATH . 'login.php?redirect=' . process_link('invoice_print', array('invoice_type' => 'product_invoice', 'invoice_id' => $mail_input_id), true);
$text_message = sprintf($text_message, $row_details['name'], $invoice_link, $this->setts['sitename']);
$html_message = sprintf($html_message, $row_details['name'], $invoice_link, $this->setts['sitename']);
send_mail($row_details['email'], 'Направлен счет - Счет ID: ' . $row_details['invoice_id'], $text_message, 
$this->setts['admin_email'], $html_message, null, $send);
?>
