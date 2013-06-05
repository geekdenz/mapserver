<?php
e("Installing dependencies...");
x("sudo apt-get install -y libfreetype6 libfreetype6-dev libpng12-dev libproj-dev libgif-dev zlib-bin libgd-tools curl-dev libcairo2-dev libfcgi-dev libxml2-dev");
e("Compiling MapServer...");
x("mkdir build");
x("./configure --with-wfs --with-postgis= --with-cairo --with-kml --with-fastcgi --prefix='". trim(`pwd`) ."/build' && make clean && make && make install && echo SUCCESS");
