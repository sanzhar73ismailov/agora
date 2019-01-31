<?
## File Version -> v6.05
## Email File -> notify user on keywords watch
## called only from the insert() function!

if ( !defined('INCLUDED') ) { die("Access Denied"); }

$keyword_search_string = $item_details['name'] . ' ' . $item_details['description'];

$sql_select_auctions = $this->query("SELECT kw.keyword, a.auction_id, a.name AS item_name,  
	u.name AS user_name, u.username, u.email FROM " . DB_PREFIX . "keywords_watch kw
	INNER JOIN " . DB_PREFIX . "auctions a ON a.auction_id='" . $mail_input_id . "'
	INNER JOIN " . DB_PREFIX . "users u ON u.user_id=kw.user_id WHERE 
	MATCH (kw.keyword) AGAINST ('" . $keyword_search_string . "')");


$send = true; ## always send

## send to all the winners of the auction for which the bank details have been set/changed
while ($watch_details = $this->fetch_array($sql_select_auctions))
{
	## text message - editable
	$text_message = 'Уважаемый(ая) %1$s,
	
Новый лот, подходящий по вашему запросу по ключевым словам, был выставлен на торги.

Название лота: %2$s.
	
Посмотреть детали по размещенному аукциону можно по ссылке:
	
%3$s
	
С уважением,
Администрация %4$s';
	
	## html message - editable
	$html_message = 'Уважаемый(ая) %1$s, <br>
<br>
Новый лот, подходящий по вашему запросу по ключевым словам, был выставлен на торги.<br>
<br>
Название лота: <b>%2$s</b><br>
<br>
[ <a href="%3$s">Ссылка</a> ] на страницу детализации. <br><br>
С уважением,<br>
Администрация %4$s';
	
	
	$auction_link = process_link('auction_details', array('name' => $watch_details['item_name'], 'auction_id' => $watch_details['auction_id']));
	
	$text_message = sprintf($text_message, $watch_details['user_name'], $watch_details['item_name'], $auction_link, $this->setts['sitename']);
	$html_message = sprintf($html_message, $watch_details['user_name'], $watch_details['item_name'], $auction_link, $this->setts['sitename']);
	
	if (!empty($watch_details['email']))
	{
		send_mail($watch_details['email'], 'Отслеживание ключевых слов - Ключевое слово: ' . $watch_details['keyword'], $text_message, 	
			$this->setts['admin_email'], $html_message, null, $send);
	}
}
?>
