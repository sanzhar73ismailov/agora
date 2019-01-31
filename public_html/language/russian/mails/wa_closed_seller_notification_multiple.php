<?
if ( !defined('INCLUDED') ) { die("Access Denied"); }
$row_details = $db->get_sql_row("SELECT u.name, u.username, u.email, u.mail_item_closed 
FROM " . DB_PREFIX . "users u WHERE u.user_id='" . $mail_input_id . "'");
$send = ($row_details['mail_item_closed']) ? true : false;
$text_message = 'Уважаемый(ая) %1$s,

Несколько объявлений, которые Вы опубликовали на сайте, устарели.

Чтобы просмотреть детали устаревших объявлений, пожалуйста, пройдите по URL указанному ниже:

%2$s

С наилучшими пожеланиями Администрация %3$s';

$html_message = 'Уважаемый(ая) %1$s,<br><br>
Несколько объявлений, которые Вы опубликовали на сайте, устарели.<br><br>
[ <a href="%2$s">Ссылка</a> ] для просмотра деталей по устаревшим объявлениям. <br><br>
С наилучшими пожеланиями ,<br>
Администрация %3$s';
$items_closed_link = SITE_PATH . 'login.php?redirect=' . process_link('members_area', array('page' => 'wanted_ads', 'section' => 'closed'));
$text_message = sprintf($text_message, $row_details['name'], $items_closed_link, $setts['sitename']);
$html_message = sprintf($html_message, $row_details['name'], $items_closed_link, $setts['sitename']);
send_mail($row_details['email'], 'Объявления закрыты', $text_message, 
$setts['admin_email'], $html_message, null, $send);
?>
