# callmeplus
Интеграция FreePBX и Битрикс24  
За основу взято  https://habrahabr.ru/post/349316/
Но переделано под реалии FreePBX
Добавлены корректные контексты , заново переосмыслены выходы из них через hangup_handler, добавлены правильные параетры для актуальной версии Битрикс24


#Настройка прав на папки

|Что | Путь | Владелец | Группа | Права | Команда
| --- | --- | --- | --- | --- | --- |
| Файлы настроек астериск - читаются только астериском| /etc/asterisk/extention_custom.conf, /etc/asterisk/manager_custom.conf  | asterisk | asterisk | 644 | - |
| Файлы PHP - выполняются веб сервером| /var/www/html/callmeplus | для Apache на FreePBX - asterisk, для Nginx на Centos - nginx, для Nignx на Debian/Ubuntu - www-data| аналогично|644|-|
| Папки для записи звука - пищет встериск, читает веб сервер |/var/www/html/callmeplus/records | asterisk | как на PHP папку | 664 | -|
| Файл логов службы - пишутся сервисом от имени пользователя PHP| /var/log/callmeplus.log | Как на PHP файлы | Как на PHP файлы | 644 | - |
| Файл логов PHP - Пишут обработчики CallMeIn и CallMeOut | /var/log/callmeplus-php.log | Как на PHP файлы | Аналогично | 644 | - |

#Схема работы
##Входящий вызов

Вызов проходит следующие конексты при использовании Ring Group и маршрутизации DID
Внешний SIP ->from-pstn ->from-pstn-custom
			->ext-did-post-custom
			->from-did-direct
			->ext-did-catchall 

##Исходящий вызов




