#!/usr/bin/env bash

wget https://sourceforge.net/projects/simplehtmldom/files/simplehtmldom/1.5/simplehtmldom_1_5.zip -O simplehtmldom.zip
unzip simplehtmldom.zip -d ./simplehtmldom/; rm simplehtmldom.zip

composer update