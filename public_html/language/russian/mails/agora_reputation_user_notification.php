<?
## File Version -> Agora.kz 6.11
## Email File -> notify user on a new reputation
## called only from the $class_reputation.php->save() function!
$san_test_mode = 0;

switch($reputation_details['reputation_type']){
	case 'sale':
		$user_type = 'покупателя';
		break;
	case 'purchase':
		$user_type = 'продавца';
		break;
	default:
		$user_type = 'Тип пользователя установлено';
		break;
}


 
if($san_test_mode){
$fp = fopen("c:/temp/logging.txt", "a"); // Открываем файл в режиме записи 
$logtext = "<<<<<<<<<<<<<<<<<<<<<\r\n"; // todo delete
}

$result = mysql_query("SELECT * FROM " . DB_PREFIX ."users WHERE user_id='" . $reputation_details['user_id'] . "'");
if (!$result) { echo 'Could not run query: ' . mysql_error(); exit;}
$row = mysql_fetch_array($result);
$user_to_whom = $row['username'];
$user_to_whom_email = $row['email'];

if($san_test_mode){
$logtext .= "reputation_details['user_id']=" . $reputation_details['user_id'] . "\r\n"; // todo delete
$logtext .= "user_to_whom= $user_to_whom\r\n"; // todo delete
$logtext .= "user_to_whom_email= $user_to_whom_email\r\n"; // todo delete
}
$result = mysql_query("SELECT * FROM " . DB_PREFIX ."users WHERE user_id='" . $reputation_details['from_id'] . "'");
if (!$result) { echo 'Could not run query: ' . mysql_error(); exit;}
$row = mysql_fetch_array($result);
$user_from_which = $row['username'];
$auction_id = $reputation_details['auction_id'];
$reput_text = $reputation_details['reputation_content'];

if($san_test_mode){
	$logtext .= "reputation_details['from_id']=" . $reputation_details['from_id'] . "\r\n"; // todo delete
	$logtext .= "user_from_which= $user_from_which\r\n"; // todo delete
	$logtext .= "auction_id= $auction_id\r\n"; // todo delete
	$logtext .= "reput_text= $reput_text\r\n"; // todo delete
}		

$result = mysql_query("SELECT sitename, admin_email FROM " . DB_PREFIX ."gen_setts LIMIT 1");
if (!$result) { echo 'Could not run query: ' . mysql_error(); exit;}
$row = mysql_fetch_array($result);
$san_sitename = $row['sitename'];
$san_admin_email = $row['admin_email'];

## text message - editable
$text_message = 'Уважаемый(ая) %1$s,

Пользователь %2$s оставил(а) на Вас следующий отзыв (аукцион %3$s):
<<<<<<<<<<<
%4$s
>>>>>>>>>>>

Для просмотра этого и других отзывов зайдите в "Моя Агора" -> "Раздел Репутация (Моя репутация)"

Всего наилучшего,
Администрация %5$s';

## html message - editable
$html_message = 'Уважаемый(ая) %1$s,<br>
<br>
Пользователь %2$s оставил(а) на Вас следующий отзыв (аукцион %3$s):<br>
<br>
<<<<<<<<<<<<br>
%4$s<br>
>>>>>>>>>>><br>
<br>
Для просмотра этого и других отзывов зайдите в "Моя Агора" -> "Раздел Репутация (Моя репутация)"<br>

Всего наилучшего,<br>
Администрация %5$s';


$text_message = sprintf($text_message, $user_to_whom , $user_from_which, $auction_id, $reput_text, $setts['sitename']);
$html_message = sprintf($html_message, $user_to_whom , $user_from_which, $auction_id, $reput_text, $setts['sitename']);

	

send_mail($user_to_whom_email, 'Получен отзыв от ' . $user_type . ' ' . $user_from_which, $text_message, $setts['admin_email'] , $html_message);
if($san_test_mode){
	$logtext .= "text_message= $text_message\r\n"; // todo delete
	$logtext .= "html_message= $html_message\r\n"; // todo delete
	$logtext .= "san_sitename=" . $san_sitename . "\r\n"; // todo delete
	$logtext .= "san_admin_email=" . $san_admin_email . "\r\n"; // todo delete
	$test = fwrite($fp, $logtext); // Запись в файл
	if ($test) echo 'Данные в файл успешно занесены.';
	else die('Ошибка при записи в файл.');
	fclose($fp); //Закрытие файла
}

 //print_r($setts); todo delete
 
 
 
?>