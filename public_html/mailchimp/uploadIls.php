<html>
<head>
   <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>Результат загрузки файла</title>
</head>
<body>
<h2><a href="index.php">Обратно на форму</a></h2>
<?php
   if($_FILES["filename"]["size"] > 1024*1*1024)
   {
     echo ("Размер файла превышает один мегабайт");
     exit;
   }
   //echo "<br/> dir: ".__DIR__."<br/>";
   // Проверяем загружен ли файл
   if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
   {
     // Если файл загружен успешно, перемещаем его
     // из временной директории в конечную
     $result = move_uploaded_file($_FILES["filename"]["tmp_name"], "../ils/ils/".$_FILES["filename"]["name"]);
	 if($result){
		 echo("<h2>Файл успешно загружен в папку ../ils/ils/</h2>");
	 }else{
		 echo("Ошибка загрузки файла");
	 }
   } else {
      echo("Ошибка загрузки файла");
   }
?>
</body>
</html>