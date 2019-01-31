11.04.2016 (08:58)
Логирование Агоры
1. Чтобы включить/выключить логирование 
   - Заходим includes/global.php
   там находим кусок:
	/* For Logging  start */
	include_once ($fileExtension . 'a_logger/logger.php'); // logger of sanzhar 04.04.2016
	Logger::$PATH = $fileExtension . "a_logs";// . "\logs";
	define ('TO_LOG', 1); // turn on logging - 1, turn off - 0
	/* For Logging  end */
	- меняем 1 на 0 в define ('TO_LOG', 1);
	
2. В файлах для логирования используем  
   $LOGGER->log("");
   Если хотим вывести массив, то конкатенацию в методе не используем (типа $LOGGER->log("имя_переменной=" . $array)) - а то вместо содержимого массива будет выводить "Array"

3. Пример использования см. в a_logger/logger.php

4. Все логи ложатся в папку site_folder/a_logs
