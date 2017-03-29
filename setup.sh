#!/usr/bin/env bash

wget https://github.com/Imangazaliev/DiDOM/archive/1.9.1.zip -O didom.zip
unzip didom.zip; rm didom.zip
mv ./DiDOM-1.9.1 ./didom

wget https://sourceforge.net/projects/simplehtmldom/files/simplehtmldom/1.5/simplehtmldom_1_5.zip -O simplehtmldom.zip
unzip simplehtmldom.zip -d ./simplehtmldom/; rm simplehtmldom.zip