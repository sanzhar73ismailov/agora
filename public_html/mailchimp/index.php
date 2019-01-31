<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Форма Mail Chimp</title>
</head>
<body>


<table border="=1">
	<tr>
		<td>
		<form name="phpinfo" action="phpinfo.php" method="get">
		    <input type="hidden" name="table" value="probid_auctions" />
			<input type="submit" name="submit" value="showPhpInfo" />
		</form>
		</td>
	</tr>
	<tr>
		<td>
		<h3><b> Форма для объявлений для ILS </b></h3>
      <form action="uploadIls.php" method="post" enctype="multipart/form-data">
      <input type="file" name="filename"><br> 
      <input type="submit" value="Загрузить"><br>
      </form>
		</td>
	</tr>
	<tr>
		<td>
		<form name="repair_probid_auctions" action="repair.php" method="get">
		    <input type="hidden" name="table" value="probid_auctions" />
			<input type="submit" name="submit" value="Repair probid_auctions" />
		</form>
		</td>
	</tr>

	<tr>
		<td>
		<form name="repair_probid_adverts" action="repair.php" method="get">
		    <input type="hidden" name="table" value="probid_adverts" />
			<input type="submit" name="submit" value="Repair probid_adverts" />
		</form>
		</td>
	</tr>

	<tr>
		<td>
		<form name="repair_probid_custom" action="repair.php" method="get">
		    <input type="input" name="table"/>
			<input type="submit" name="submit" value="Repair entered table" />
		</form>
		</td>
	</tr>
	
	<tr>
		<td>
		<form name="show_gmail_users" action="statistica.php" method="get">
		    <input type="submit" name="submit" value="Statistica" />
		</form>
		</td>
	</tr>
	<tr>
		<td>
		<form name="show_gmail_users" action="show_table.php" method="get">
		     <input type="hidden" name="table" value="gmail_users" />
		     Today <input type="checkbox" name="today" value="1"/>
		     Days ago <input type="number" name="daysago" size="5" />
		    <input type="submit" name="submit" value="Show gmail users" />
		</form>
		</td>
	</tr>
	
	<tr>
		<td>
		<form name="show_vizit_users" action="show_table.php" method="get">
		     <input type="hidden" name="table" value="vizit_users" />
		     Today <input type="checkbox" name="today" value="1"/>
		     Days ago <input type="number" name="daysago" size="5" />
		    <input type="submit" name="submit" value="Show vizit users" />
		</form>
		</td>
	</tr>
	
	<tr>
		<td>
		<form name="show_messages_users" action="show_table.php" method="get">
		     <input type="hidden" name="table" value="store_subscr" />
		     Today <input type="checkbox" name="today" value="1"/>
		     Days ago <input type="number" name="daysago" size="5" />
		    <input type="submit" name="submit" value="Show messages" />
		</form>
		</td>
	</tr>
	
	<tr>
		<td>
		<form name="show_relisted_auctions" action="show_table.php" method="get">
		     <input type="hidden" name="table" value="relisted_auctions" />
		     Today <input type="checkbox" name="today" value="1"/>
		     Days ago <input type="number" name="daysago" size="5" />
		    <input type="submit" name="submit" value="Show relisted auctions" />
		</form>
		</td>
	</tr>
	
	<tr>
		<td>
		<form name="show_duplicates" action="show_duplicates.php" method="get">
		     <input type="hidden" name="table" value="" />
		    <input type="submit" name="submit" value="Show duplicates" />
		</form>
		</td>
	</tr>
	
	
</table>




<table border="=1">
	<tr>
		<td>
		<h2>1) Обновить таблицу пользователей для MailChimp</h2>
		<form name="refreshusers_form" action="action.php" method="get"><input
			type="submit" name="refresh_users" value="Ok" /></form>
		</td>
	</tr>


	<tr>
		<td>
		<h2>2) Загрузить файл subscribed</h2>
		<form enctype="multipart/form-data" action="action.php" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="500000" /> <!-- Название элемента input определяет имя в массиве $_FILES -->
		Отправить этот файл: <input name="userfile" type="file" /> <input
			type="submit" name="send_file_subscribed" value="Send File" /></form>
		</td>
	</tr>
	
	<tr>
		<td>
		<h2>3) Загрузить файл unsubscribed</h2>
		<form enctype="multipart/form-data" action="action.php" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="500000" /> <!-- Название элемента input определяет имя в массиве $_FILES -->
		Отправить этот файл: <input name="userfile" type="file" /> <input
			type="submit" name="send_file_unsubscribed" value="Send File" /></form>
		</td>
	</tr>

      <tr>
		<td>
		<h2>4) Загрузить файл cleaned</h2>
		<form enctype="multipart/form-data" action="action.php" method="POST">
		<input type="hidden" name="MAX_FILE_SIZE" value="500000" /> <!-- Название элемента input определяет имя в массиве $_FILES -->
		Отправить этот файл: <input name="userfile" type="file" /> <input
			type="submit" name="send_file_cleaned" value="Send File" /></form>
		</td>
	</tr>
	
	<tr>
		<td>
		<h2>5) Вывести для MailChimp список для добавления</h2>
		<form name="refreshusers_form" action="action.php" method="get"><input
			type="submit" name="get_new_users" value="Ok" /></form>
		</td>
	</tr>

</table>



</body>
</html>
