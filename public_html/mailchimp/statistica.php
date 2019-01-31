<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Show <?php echo $_REQUEST["table"]; ?></title>
<style>

   .td_big {
    padding: 5px; /* Поля в ячейках */
    vertical-align: top; /* Выравнивание по верхнему краю ячеек */
   }
  </style>
</head>
<body>
<h2><a href="index.php">Обратно на форму</a></h2>
<?php include 'config.php'; ?>
<?php include 'functions.php'; ?>


<?php

$QUERY_DAYLY = "select DATE_FORMAT(insert_date,'%Y-%m-%d') AS date, DATE_FORMAT(insert_date,'%W') AS Day_Week, count(*) AS num, COUNT( DISTINCT username ) AS uniq_num from vizit_users group by DATE_FORMAT(insert_date,'%Y-%m-%d') order by id desc";
$QUERY_WEEKLY = "select DATE_FORMAT(insert_date,'%u-%Y') AS Week, CONCAT(DATE_FORMAT(min(insert_date),'%d-%b'),' - ',DATE_FORMAT(max(insert_date),'%d-%b')) AS period, count(*) AS num, COUNT( DISTINCT username ) AS uniq_num from vizit_users group by DATE_FORMAT(insert_date,'%u-%Y') order by insert_date desc";
$QUERY_MONTHLY = "select DATE_FORMAT(insert_date,'%b-%Y') AS Month, COUNT(*) AS num, COUNT(DISTINCT username) AS uniq_num from vizit_users group by DATE_FORMAT(insert_date,'%b-%Y') order by insert_date desc";


function printTableAsString($title,$query){
	$result = mysql_query($query) or die('Запрос не удался: ' . mysql_error());
	if($result){
		echo "<h3>$title</h3>"; 
		// Выводим результаты в html
		echo "<table border='1'>\n";
		//echo "<tr><td>Date</td><td>Day of week</td><td>Num</td><td>Unique num</td></tr>\n";
		while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$color = "";
			if($i % 2 == 0) {
				$color = "#607D8B";
			}
			echo "\t<tr style='background-color: $color;'>\n";
			foreach ($line as $col_value) {
				
				echo "\t\t<td>$col_value</td>\n";
			}
			echo "\t</tr>\n";
			$i++;
		}
		echo "</table>\n";
		// Освобождаем память от результата
		mysql_free_result($result);
	} else {
		echo "Проблема с отображением таблицы<br/>\n";
	}
}

if(isset($_REQUEST["submit"])){
   
	
	echo "<table border='0'><tr>";
	echo "<td class='td_big'>";
	printTableAsString("Dayly statistics", $QUERY_DAYLY);
	echo "</td>";
	echo "<td class='td_big'>";
	printTableAsString("Weekly statistics", $QUERY_WEEKLY);
	echo "</td>";
	echo "<td class='td_big'>";
	printTableAsString("Monthly statistics", $QUERY_MONTHLY);
	echo "</td>";
	echo "</tr></table>";

}else{
	echo "Откуда приехали?<br/>\n";
}


?>

</body>
</html>
