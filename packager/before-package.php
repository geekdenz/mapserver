<?php
e("Installing dependencies...");
x("sudo apt-get install -y libfreetype6 libfreetype6-dev libpng12-dev libproj-dev libgif-dev zlib-bin libgd-tools libcairo2-dev libfcgi-dev libxml2-dev libgd2-xpm-dev libcurl4-openssl-dev libgeos-dev libghc6-svgcairo-dev libsvg-cairo php5-dev");
e("Compiling MapServer...");
x("mkdir build");
x("./configure --prefix='". trim(`pwd`) ."/build' --with-proj --with-geos --with-gdal=/usr/local/bin/gdal-config ".
    "--with-ogr --with-postgis --with-cairo --with-wmsclient --with-wfs --with-wfsclient --with-wcs --with-curl-config ".
    "--with-xml2-config --with-sos --with-fastcgi --with-freetype --with-gd --with-jpeg --with-png --with-kml --with-threads ".
    "--with-libsvg-cairo --with-php=/usr/bin/php-config ".
    "&& make clean && make && make install && echo SUCCESS");
// x("./configure --with-wfs --with-postgis= --with-cairo --with-kml --with-fastcgi --prefix='". trim(`pwd`) ."/build' && make clean && make && make install && echo SUCCESS");
//x("./configure --with-wfs --with-postgis= --with-cairo --with-kml --with-fastcgi --prefix='". trim(`pwd`) ."/build' && make clean && make && make install && echo SUCCESS");
