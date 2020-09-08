#!/bin/bash

echo ============================================================================
echo '                            Welcome setup script'
echo
echo

read -p "Enter asterisk AMI username [callme]: " auser
auser=${auser:-'callme'}

read -p "Enter password for user $auser [random generate]: " apass
apass=${apass:-'JD3clEB8_f23r-3ry84g11'}


read -p "Enter IP (comma separate) allow for user $auser [127.0.0.1/255.255.255.255]: " aip
aip=${aip:-'127.0.0.1/255.255.255.255'}

read -p "Enter AMI port [5038]: " aport
aport=${aport:-5038}

read -p "Enter external URL for YOU site [https://example.com/callme]: " aport
aurl=${aurl:-5038}

read -p "Enter path to install calme PHP suite [/var/www/html]: " apath
apath=${apath:-'/var/www/html'}

read -p "Enter token for outbound hook BITRIX (go to https://##YOUPATH.bitrix24.ru/marketplace/hook/ ) [null]: " atoken
atoken=${atoken:-''}

read -p "Enter bitrix URL for inbound hook [null]: " abiturl
abiturl=${abiturl:-''}

echo ============================================================================
echo '                            Create config files'

mkdir -p ./tmp/asterisk

cat ./asterisk/manager_custom.conf | sed  "s~{{IP}}~$aip~g" |sed "s~{{USER}}~$auser~g" |sed "s~{{PASS}}~$apass~g"  > ./tmp/asterisk/manager_custom.conf
cat ./asterisk/extensions_custom.conf| sed "s~{{URL}}~$aurl~g" |sed "s~{{PATH}}~$apath~g"  > ./tmp/asterisk/extensions_custom.conf

cat ./callme/config-dist.php | sed "s~{{BITURL}}~$abiturl~g"| sed  "s~{{PORT}}~$aport~g" |\
sed "s~{{USER}}~$auser~g" |sed "s~{{PASS}}~$apass~g"  \
sed "s~{{TOKEN}}~$atoken~g" |sed "s~{{BITURL}}~$abiturl~g"  \
> ./callme/config.php


