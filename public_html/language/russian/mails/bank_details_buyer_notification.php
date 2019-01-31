<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$sql_select_auctions = $db->query("SELECT a.auction_id, a.name AS item_name, a.bank_details, 
u.name AS buyer_name, u.username, u.email FROM " . DB_PREFIX . "winners w
LEFT JOIN " . DB_PREFIX . "auctions a ON a.auction_id=w.auction_id
LEFT JOIN " . DB_PREFIX . "users u ON u.user_id=w.buyer_id
WHERE w.auction_id='" . $mail_input_id . "'");
$send = true;
while ($bank_details = $db->fetch_array($sql_select_auctions))
{
$text_message = 'Уважаемый(ая) %1$s,
	
Продавец предложения %2$s, который Вы выиграли, разместил/изменил данные о банковских реквизитах.
	
Бнковские данные:
	
%3$s
	
Более детально о покупке Вы узнаете по нижеследующей ссылке:  
	
%4$s
	
После посещения предыдущей страници, пройдите в "Просмотр деталей банка" по ссылке рядом с выигранным лотом.
	
С уважением, Администрация %5$s ';
$html_message = 'Уважаемый(ая) %1$s, <br><br>
Продавец предложения %2$s, который Вы выиграли, разместил/изменил данные о банковских реквизитах.<br><br>
Детали банка: <br><ul><li>%3$s </li></ul><br>
Более детально о покупке Вы узнаете по нижеследующей [ <a href="%4$s">ссылке</a> ] .<br><br>
После посещения предыдущей страници, пройдите в "Просмотр деталей банка" по ссылке рядом с выигранным лотом.<br><br>
С уважением, Администрация %5$s';
$items_won_link = SITE_PATH . 'login.php?redirect=' . process_link('members_area', array('page' => 'bidding', 'section' => 'won_items'));
$text_message = sprintf($text_message, $bank_details['buyer_name'], $bank_details['item_name'], $bank_details['bank_details'], $items_won_link, $setts['sitename']);
$html_message = sprintf($html_message, $bank_details['buyer_name'], $bank_details['item_name'], $bank_details['bank_details'], $items_won_link, $setts['sitename']);
send_mail($bank_details['email'], 'Аукцион ID: ' . $bank_details['auction_id'] . ' - детали банка направлены почтой', $text_message, 
$setts['admin_email'], $html_message, null, $send);
}
?>
