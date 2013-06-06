<?php
e("Installing dependencies...");
$apt_deps = array(
    'libfreetype6',
    'libfreetype6-dev',
    'libpng12-dev',
    'libproj-dev',
    'libgif-dev',
    'zlib-bin',
    'libgd-tools',
    'libcairo2-dev',
    'libfcgi-dev',
    'libxml2-dev',
    'libgd2-xpm-dev',
    'libgeos-dev',
    'libghc6-svgcairo-dev',
    'libgdal-dev',
    'libgdal1-dev',
    'libghc-svgcairo-dev',
    'libsvg-cairo',
    'libcurl4-gnutls-dev',
    'php5-dev',
    'gcc',
    'make',
    //'apache2',
    //'apache2-mpm-worker',
    //'libapache2-mod-fastcgi',
    //'',
);
x("sudo apt-get install -y ". implode(' ', $apt_deps));
e("Compiling MapServer...");
x("mkdir build");
$prefix = "'". trim(`pwd`) ."/build'";
//x("./configure --exec-prefix=$prefix --prefix=$prefix --with-proj --with-geos --with-gdal=/usr/local/bin/gdal-config ");

/*
proj geos gdal ogr postgis cairo wmsclient wfs wfsclient wcs curl-config xml2-config sos fastcgi freetype gd jpeg png kml threads libsvg-cairo php
*/
x("./configure --with-proj --with-geos --with-gdal ".//=/usr/local/bin/gdal-config ".
    "--with-ogr --with-postgis --with-cairo --with-wmsclient --with-wfs --with-wfsclient --with-wcs --with-curl-config ".
    "--with-xml2-config --with-sos --with-fastcgi --with-freetype --with-gd --with-jpeg --with-png --with-kml --with-threads ".
    "--with-libsvg-cairo --with-php=/usr/bin/php-config ".
    "&& make clean && make && make install DESTDIR=$prefix && echo SUCCESSFULLY COMPILED");
// x("./configure --with-wfs --with-postgis= --with-cairo --with-kml --with-fastcgi --prefix='". trim(`pwd`) ."/build' && make clean && make && make install && echo SUCCESS");
//x("./configure --with-wfs --with-postgis= --with-cairo --with-kml --with-fastcgi --prefix='". trim(`pwd`) ."/build' && make clean && make && make install && echo SUCCESS");
