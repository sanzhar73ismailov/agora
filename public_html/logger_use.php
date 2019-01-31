<?php


include_once ('includes/global.php');
include_once ('a_logger/logger.php'); // logger of sanzhar 04.04.2016
$LOGGER = Logger::getLogger("logger_use.php", null, TO_LOG); // задаем путь для хранения лог файлов





//include_once ('a_logger/init_logger.php');
/*
echo "<h1>Hello, today " .  date("d M Y")  . "</h1>";

$d=time();
echo "Created date is " . date("Y-m-d h:i:sa", $d);
$log111='['.date('D M d H:i:s Y',time()).'] ';
echo "<br>Created date is " . $log111;

$ob = array("1"=>"one", "2"=>"two", array(12=>"asd"));
$LOGGER->log("\$ob" . $ob);

$LOGGER->log("hello");
$LOGGER->log("hello2");
$LOGGER->log("hello3");

$values = array(false, true, null, 'abc', '23', 23, '23.5', 23.5, '', ' ', '0', 0);
foreach ($values as $value) {
	echo "is_string(";
	var_export($value);
	echo ") = ";
	echo var_dump(is_string($value));
}
echo "----------<br>";
foreach ($ob as $value) {
	echo "is_string(";
	var_export($value);
	echo ") = ";
	echo var_dump(is_string($value));
}
*/
$var1 = 123;
echo "\$var1" . "<br>";
echo '$var1' . "<br>";

?>
