<?php 
return array(

	'CallMeDEBUG' => 1, // дебаг сообщения в логе: 1 - пишем, 0 - не пишем
	'LogPath' => '/var/log/callmeplus-php.log', //По умолчанию /var/log/callmeplus-php.log
	'tech' => 'PJSIP', //Frepbx по умолчанию
	'authToken' => 'klumlkm2lkmlkh3j', //токен авторизации битрикса для CamllMeOut.php
	'bitrixApiUrl' => 'https://aaaaaa.bitrix24.ru/rest/7/klupoblkmlkmlk2m34h3j/', //url к api битрикса (входящий вебхук) для отсылки через CallMeIn.php
	'extentions' => array('1100','s'), // список внешних номеров, через запятую - все равно только с 's' заработало
	'context' => 'from-internal', //исходящий контекст для оригинации звонка
	'asterisk' => array( // настройки для подключения к астериску
		    'host' => '127.0.0.1',
		    'scheme' => 'tcp://',
		    'port' => 5038,
		    'username' => 'callme',
		    'secret' => 'dDfcgEB8_f23r-3ry84gJ',
		    'connect_timeout' => 10000,
		    'read_timeout' => 10000
		),
	'listener_timeout' => 300, //скорость обработки событий от asterisk

);
