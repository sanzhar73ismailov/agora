<?php

//define("USER", "root");
//define("PASS", "elsieltc");
//define("DB", "test");
//define("HOST", "192.168.10.80");



define("HOST", "localhost");
define("USER", "agorakz_agora611");
define("PASS", "1qaz+2wsx");
define("DB", "agorakz_agora611");


$link = mysql_connect(HOST, USER, PASS) or die('Не удалось соединиться: ' . mysql_error());
mysql_query("set names 'utf8'",$link);
//echo 'Соединение успешно установлено';
mysql_select_db(DB) or die('Не удалось выбрать базу данных');


/*
CREATE TABLE mailchimp_users (
  user_id INTEGER(11) NOT NULL,
  username VARCHAR(255) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  email VARCHAR(255) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  mailchimp_status TINYINT(1) NOT NULL DEFAULT '0' COMMENT '0-not in mailchimp list, 1-as subscribed, 2-as unsubscribed, 1-as cleaned',
  PRIMARY KEY (user_id)
)ENGINE=MyISAM
CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';
 
  
 */

?>