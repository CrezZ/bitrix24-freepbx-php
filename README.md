# callmeplus
Интеграция FreePBX и Битрикс24  
За основу взято  https://habrahabr.ru/post/349316/
Но переделано под реалии FreePBX
Добавлены корректные контексты , заново переосмыслены выходы из них через hangup_handler, добавлены правильные параетры для актуальной версии Битрикс24

## Полное описание тут https://habr.com/ru/post/518450/


# Содержимое папок
- asterisk - Шаблоны и пример диалланов для FeeBPX на основе _custom.conf_ файлов, а также файл manager_custom.conf для настройки AMI(там есть пароль!)
- callmeplus - PHP скрипты для обработки входящих вызовов (через Asterisk AMI соединение) и исходящих (из битрикса через Webhook, из астериска через прямой вызов URL командой curl). ТРебует создания файла config.php из шаблона или примерав (config-dist.php,config-dist-old.php)
- nginx - конфиг для nginx с учетом LetsEncrypt webroot. Требует правки путей, имени домена, пути к нужной версии php-fpm.sock ...
- apache - конфиг для Apache с учетом LetsEncrypt webroot. Требует правки путей, имени домена...
- systemd - файл для создания сервиса обработки входящих. Требует правки в части пользователя (такой же как на папку PHP) и пути размещения PHP скриптов
- setup.sh - по идее скрипт, который спросит вас о всех параметрах и сам все настроит. Но может не завестись LetsEncrypt, особенно если на ваше сервере его еще не было. 

# Настройка прав на папки

|Что | Путь | Владелец | Группа | Права | Команда
| --- | --- | --- | --- | --- | --- |
| Файлы настроек астериск - читаются только астериском| /etc/asterisk/extention_custom.conf, /etc/asterisk/manager_custom.conf  | asterisk | asterisk | 644 | - |
| Файлы PHP - выполняются веб сервером| /var/www/html/callmeplus | для Apache на FreePBX - asterisk, для Nginx на Centos - nginx, для Nignx на Debian/Ubuntu - www-data| аналогично|644|-|
| Папки для записи звука - пищет встериск, читает веб сервер |/var/www/html/callmeplus/records | asterisk | как на PHP папку | 664 | -|
| Файл логов службы - пишутся сервисом от имени пользователя PHP| /var/log/callmeplus.log | Как на PHP файлы | Как на PHP файлы | 644 | - |
| Файл логов PHP - Пишут обработчики CallMeIn и CallMeOut | /var/log/callmeplus-php.log | Как на PHP файлы | Аналогично | 644 | - |

# Схема работы
## Входящий вызов

Вызов проходит следующие конексты при использовании Ring Group и маршрутизации DID
Внешний SIP ->from-pstn ->from-pstn-custom 
			->ext-did-post-custom
			->from-did-direct ( --> ## ext-did-custom )
			->ext-did-catchall 

## Исходящий вызов
Внешний SIP ->from-internal ->from-internal-noxfer (-> from-internal-noxfer-custom
							->from-internal-noxfer-additional)
			->from-internal-xfer (->from-internal-custom 
						-> from-internal-additional
								-->> ## outbound-allroutes-custom)
			->bad-number
			




