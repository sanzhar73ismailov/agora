<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Show <?php echo $_REQUEST["table"]; ?></title>
</head>
<body>
<h2><a href="index.php">Обратно на форму</a></h2>
<?php include 'config.php'; ?>
<?php include 'functions.php'; ?>


<?php

if(isset($_REQUEST["submit"])){

   $table = $_REQUEST["table"];

    
     
	echo "<h1>Пользователи $table </h1>";
	$query =  "select * from  $table order by id";
	$result = mysql_query($query) or die('Запрос не удался: ' . mysql_error());
	
	if($result){
		// Выводим результаты в html
		echo "<table border='1'>\n";
		while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
			echo "\t<tr>\n";
			foreach ($line as $col_value) {
				echo "\t\t<td>$col_value</td>\n";
			}
			echo "\t</tr>\n";
		}
		echo "</table>\n";
		
		echo "==========================\n";

		// Освобождаем память от результата
		mysql_free_result($result);
	}else{
		echo "Проблема с починкой таблицы<br/>\n";
	}

}else{
	echo "Откуда приехали?<br/>\n";
}


?>

</body>
</html>
