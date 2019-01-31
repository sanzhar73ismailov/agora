57 14052014 
подправил register.php обратоно вернул старую регистрацию
в functions.php раскомментировал строку 626, чтобы появлялся чекбокс 
под условиями регистрации в регист форме.

58 02092014
файл themes\ultra\img\system\check_img.gif заменил на другой (старая картинка изображал красную галочку, новая изображает зеленую, интуитивно понятней, что все нормально)

60 19092014 в папке mail_chimp добавил файл repair.php и изменил index.php, чтобы можно было чинить таблицы

61 в includes\functions.php добавил в функцию send_mail строку, копирующую gnail адреса в бд

62 26092014
а) в файл login.php добавлено строка 63 след код:
			if(IS_TO_INSERT_LOGGED_USERS == 1 && $login_output['active'] == 'Active'){
			    $vizit_query = sprintf("INSERT INTO vizit_users (username, email) VALUES ('%s', '%s')", $login_output['username'],$login_output['email']);
				$db->query($vizit_query);
			}
   который вносит всех вошедших пользователей в таблицу vizit_users
   
   на строке 18 чтобы можно было отключать это дело
   include_once ('includes/san_settings.php'); // added by sanzhar 290914
   
б) в файл includes/san_settings.php внесено на строке 2:
   define('IS_TO_INSERT_LOGGED_USERS','1'); 
г) изменил файл agora/includes/class_fees.php (см строки 2298-2310)
д) в файле testnew__\language\russian\mails\store_expiration_notification.php закоментировал отправку писем насчет истечения срока подписки

63 30092014
1) в includes\functions.php добавил в функцию send_mail строку, прерывающу функцию отправки почты, если тема содержит "подписки на пользование магазином"
2) в файле testnew__\language\russian\mails\store_expiration_notification.php разкоментировал отправку писем насчет истечения срока подписки
3) изменил mailchimp/index.php - добавил возможность просмотра списка отправленных писем

64 09102014
изменил файл agora/includes/class_fees.php - возобновил активацию магазинов (см строки 2298-2310)

68 16012015
создал таблицу relisted_auctions - для выявления дубликатов
изменил class_item.php:
1) стр 17 - define('IS_COPY_RELIST_AUCTIONS','1'); //added by Sanzhar 160115 - чтобы можно было отключить код на стро 2788
2) стр 2788 - скрипт вносит обновляемые аукционы в таблицу relisted_auctions (и новый и старый auction_id)
добавил кнопку для просмотра таблицы relisted_auctions в mailchimp/index.php

69 16012015 - в 23.52
1. Исправил два крон файла 
- mail_chimp/cron_delete_duplicates.php
- ajax_files/images_removal_tool_by_san.php
2. Добавил еще один крон файл удаления аукционов
- admin\delete_marked_by_san.php

71 24082015
Добавил возможность загрузки в файл mailchimp/index.php (формочку)
Для этого создал файл mailchimp/uploadIls.php.php

75 22012016
Добавил возможность поиска в МОЯ АГОРА коротких слов, типа "сша"
1. Создал функцию getLikeForSql
2. стр 359 $src_auctions_query формируется с помощью этой функции. Теперь вместо полнотекстового поиска испльзуется Like для каждого слова
3. убрал использоваине sprintf в 3х местах (стр 2506, 2509, 2514) - так как использование like '%%' и последующего %s вместе со sprint_f вызывало ошибку 

76 16022016
В mailchimp добавил статистику

77 08032016
В mailchimp добавил статистику по неделям и месяцам

78 14042016
большая переделка по реализации оплаты

79 в админке сделал скрытие кнопки "Оплата" для тех кто уже оплатил - можно ее показывать, только если пометить чекбокс

80 20052016
В логере убрал обращение к файлу - чтобы увеличить скорость

81 01082016
добавил каптчу для регистрации:
1. Добавил kaptcha.php в папку includes
2. Изменил templates\register.tpl.php
3. Изменил register.php