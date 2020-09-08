<?php 
return array(

	'CallMeDEBUG' => 1, // дебаг сообщения в логе: 1 - пишем, 0 - не пишем
	'tech' => 'PJSIP', 
	'authToken' => '{{TOKEN}}', //токен авторизации битрикса
	'bitrixApiUrl' => '{{BITURL}}', //url к api битрикса (входящий вебхук)
	'extentions' => array('s'), // список внешних номеров, через запятую
	'context' => 'from-internal', //исходящий контекст для оригинации звонка
	'asterisk' => array( // настройки для подключения к астериску
		    'host' => '127.0.0.1',
		    'scheme' => 'tcp://',
		    'port' => {{PORT}},
		    'username' => '{{USER}}',
		    'secret' => '{{PASS}}',
		    'connect_timeout' => 10000,
		    'read_timeout' => 10000
		),
	'listener_timeout' => 300, //скорость обработки событий от asterisk

);
