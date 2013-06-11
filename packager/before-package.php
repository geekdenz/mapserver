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
    'libfribidi-dev',
    'php5-dev',
    'gcc',
    'make',
    'cmake',
);
x("sudo apt-get install -y ". implode(' ', $apt_deps));
e("Compiling MapServer...");
x("mkdir build");
$prefix = "'". trim(`pwd`) ."/build'";
//x("./configure --enable-debug --with-proj --with-geos --with-gdal ".//=/usr/local/bin/gdal-config ".
    //"--with-ogr --with-postgis --with-cairo --with-wmsclient --with-wfs --with-wfsclient --with-wcs --with-curl-config ".
    //"--with-xml2-config --with-sos --with-fastcgi --with-freetype --with-gd --with-jpeg --with-png --with-kml --with-threads ".
    //"--with-libsvg-cairo --with-php=/usr/bin/php-config ".
    //"&& make clean && make && make install DESTDIR=$prefix && echo SUCCESSFULLY COMPILED");
x("cd $prefix && cmake ".
"--enable-debug -DWITH_PROJ=1 -DWITH_GEOS=1 -DWITH_GDAL=1 ".
"-DWITH_OGR=1 -DWITH_POSTGIS=1 -DWITH_CAIRO=1 -DWITH_WMSCLIENT=1 -DWITH_WFS=1 -DWITH_WFSCLIENT=1 -DWITH_WCS=1 -DWITH_CURL_CONFIG=1 ".
"-DWITH_XML2_CONFIG=1 -DWITH_SOS=1 -DWITH_FASTCGI=1 -DWITH_FREETYPE=1 -DWITH_GD=1 -DWITH_JPEG=1 -DWITH_PNG=1 -DWITH_KML=1 -DWITH_THREADS=1 ".
"-DWITH_LIBSVG_CAIRO=1 -DWITH_PHP=/usr/bin/php-config ".
"..");
$root = str_replace("'", '', $prefix .'/root');
x("cd $prefix && mkdir -p $root && make clean && make DESTDIR=$root ".
"&& make install DESTDIR=$root");
x("mkdir -p $root/etc/php5/apache2/conf.d");
file_put_contents($root .'/etc/php5/apache2/conf.d/mapscript.ini', "; loading mapscript extension\n".
        "extension=/usr/lib/php5/20090626/php_mapscript.so");
