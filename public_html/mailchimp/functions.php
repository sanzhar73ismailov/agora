<?php

function getListOfMailsFromFile($file_name){
	$stringArray = array();
	$fp = fopen($file_name, "rt");
	if ($fp){
		$row=0;
		while (!feof($fp))	{
			$mytext = fgets($fp, 999);
			$pieces = explode(",", $mytext);
			if($row++ > 0 and strlen($pieces[0]) > 0){
				if (filter_var($pieces[0], FILTER_VALIDATE_EMAIL)) {
					$stringArray[] = $pieces[0];
				}else{
					exit("E-mail (email_a) указан неверно: " . $pieces[0]);
				}

			}
		}
	}else{
		echo "Ошибка при открытии файла";
	}
	fclose($fp);
	return $stringArray;
}

function readFileUpdateMailChimpUsers($tmp_file_name,  $status){
	$arrayMails = getListOfMailsFromFile($tmp_file_name);
	echo "количество эл почт в загруженном файле: " . count($arrayMails) . "<br/>";
	$comma_separated = "'". implode("', '", $arrayMails) . "'";
	updateMailChimpUsers($comma_separated, $status);
}

function updateMailChimpUsers($listMails, $status){

	$query =  "update mailchimp_users mu set mailchimp_status = $status
	          where mu.email in (" . $listMails . ")";
	//echo $query;
	//return;

	$result = mysql_query($query) or die('Запрос не удался: ' . mysql_error());

	if($result){
		printf("<font color='green'>Таблица обновлена, обновлено записей: %d</font><br/>\n", mysql_affected_rows());
	}else{
		echo "<font color='red'>Проблема со вставкой данных</font><br/>\n";
	}
}

function writeListMailFile(){
	$arrayEmails = getNewMailsForChimp();

	$file_name = "list_mails.txt";
	$fp = fopen($file_name, "w");

	foreach ($arrayEmails as $email){
		$test = fwrite($fp, $email . "\n");
		//if ($test) echo 'Данные в файл успешно занесены.';
		//else echo 'Ошибка при записи в файл.';
	}
	fclose($fp); //Закрытие файла
	
   //header('Content-type: text/plain');
   //header("Content-Disposition: attachment; filename=\"$file_name\"");
   //$x = fread(fopen("$file_name", "rb"), filesize("$file_name"));
   echo "<a href='" . $file_name. "'>скачать</a>";
}

function getNewMailsForChimp(){
	$limit = 0;
	$returnArray = array();


	$resultCount = mysql_query("select count(*) from  mailchimp_users where  `mailchimp_status` = 1");
	$limit = mysql_result($resultCount, 0);
	$limit = 2000 - $limit;
	echo "кол-во адресов: " . $limit . "<br/>";

	$query =  "select mu.email as email from mailchimp_users mu where mailchimp_status = 0
	           order by mu.user_id desc limit " . $limit;

	$result = mysql_query($query) or die('Запрос не удался: ' . mysql_error());
	while ($line = mysql_fetch_array($result)){
		$returnArray[] = $line[0];

	}
	mysql_free_result($resultCount);
	mysql_free_result($result);

	return $returnArray;
}

?>