<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Action Page Mail Chimp</title>
</head>
<body>
<h2><a href="index.php">Обратно на форму</a></h2>
<?php include 'config.php'; ?>
<?php include 'functions.php'; ?>


<?php

define("NOT_IN_MAILCHIMP", 0);
define("SUBSCRIBED", 1);
define("UNSUBSCRIBED", 2);
define("CLEANED", 3);


if(isset($_REQUEST["refresh_users"])){

	$query =  "insert into mailchimp_users  (user_id, username, email)
              select u.user_id, u.username, u.email from probid_users u 
              where 1=1
              and u.active=1 
              and u.user_id not in (select mc2.user_id from mailchimp_users mc2)
              order by u.user_id";

	$result = mysql_query($query) or die('Запрос не удался: ' . mysql_error());
	if($result){
		printf("Таблица обновлена, добавлено записей: %d<br/>\n", mysql_affected_rows());
	}else{
		echo "Проблема со вставкой данных<br/>\n";
	}

}elseif($_REQUEST["send_file_subscribed"]){

	if(strpos($_FILES['userfile']['name'], "_subscr")){

		readFileUpdateMailChimpUsers($_FILES['userfile']['tmp_name'], SUBSCRIBED);

	}else{
		exit("<font color='red'>Файл забыли прикрепить или он не являестя 'subscribed'!</font>");
	}

}elseif($_REQUEST["send_file_unsubscribed"]){

	if(strpos($_FILES['userfile']['name'], "_unsubscr")){

		readFileUpdateMailChimpUsers($_FILES['userfile']['tmp_name'], UNSUBSCRIBED);

	}else{
		exit("<font color='red'>Файл забыли прикрепить или он не являестя 'unsubscribed'!</font>");
	}


}elseif($_REQUEST["send_file_cleaned"]){

	if(strpos($_FILES['userfile']['name'], "_clean")){

		readFileUpdateMailChimpUsers($_FILES['userfile']['tmp_name'], CLEANED);

	}else{
		exit("<font color='red'>Файл забыли прикрепить или он не являестя 'cleaned'!</font>");
	}


}elseif($_REQUEST["get_new_users"]){

	writeListMailFile();

}






?>

</body>
</html>
