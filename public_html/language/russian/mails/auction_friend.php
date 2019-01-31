<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$sender_details = $this->get_sql_row("SELECT u.name, u.email FROM " . DB_PREFIX . "users u WHERE u.user_id='" . $user_id . "'");
$send = true;
$text_message = 'Уважаемый(ая) %1$s,

Ваш друг, %2$s, послал аукцион, размещенный на %3$s для Вашего внимания.

Посмотреть детали Вы можете по нижеследующей ссылке:

%4$s

Комментарии: %5%s
С уважением,  Администрация %6$s';
$html_message = 'Уважаемый(ая) %1$s, <br><br>
Ваш друг, %2$s, послал аукцион, размещенный на %3$s для Вашего внимания.<br><br>
[ <a href="%4$s">Ссылка</a> ] на детали аукциона.<br><br>
Комментарии: %5$s <br><br>
С уважением, Администрация %6$s';
$auction_link = process_link('auction_details', array('name' => $item_details['name'], 'auction_id' => $item_details['auction_id']));
$text_message = sprintf($text_message, $friend_name, $sender_details['name'], $this->setts['sitename'], $auction_link, $comments, $this->setts['sitename']);
$html_message = sprintf($html_message, $friend_name, $sender_details['name'], $this->setts['sitename'], $auction_link, $comments, $this->setts['sitename']);
send_mail($friend_email, 'Проверьте предложение', $text_message, 
$sender_details['email'], $html_message, $sender_details['name'], $send);
?>
