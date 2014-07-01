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
$pwd = trim(`pwd`);
$prefix = "'$pwd/build'";
//x("./configure --enable-debug --with-proj --with-geos --with-gdal ".//=/usr/local/bin/gdal-config ".
    //"--with-ogr --with-postgis --with-cairo --with-wmsclient --with-wfs --with-wfsclient --with-wcs --with-curl-config ".
    //"--with-xml2-config --with-sos --with-fastcgi --with-freetype --with-gd --with-jpeg --with-png --with-kml --with-threads ".
    //"--with-libsvg-cairo --with-php=/usr/bin/php-config ".
    //"&& make clean && make && make install DESTDIR=$prefix && echo SUCCESSFULLY COMPILED");
x("cd $prefix && cmake ".
"-DWITH_PROJ=ON -DWITH_GEOS=ON -DWITH_GDAL=ON ".
"-DWITH_OGR=ON -DWITH_POSTGIS=ON -DWITH_CAIRO=ON -DWITH_WFS=ON -DWITH_WFSCLIENT=ON -DWITH_WCS=ON -DWITH_CURL_CONFIG=ON -DWITH_CURL=ON".
"-DWITH_XML2_CONFIG=ON -DWITH_SOS=ON -DWITH_FASTCGI=ON -DWITH_FREETYPE=ON -DWITH_GD=ON -DWITH_JPEG=ON -DWITH_PNG=ON -DWITH_KML=ON -DWITH_THREADS=ON ".
"-DWITH_LIBSVG_CAIRO=ON -DWITH_PHP=/usr/bin/php-config -DWITH_CLIENT_WMS=ON ".
"..");
$root = str_replace("'", '', $prefix .'/root');
x("cd $prefix && mkdir -p $root && make DESTDIR=$root ".
//x("cd $prefix && mkdir -p $root && make clean && make DESTDIR=$root ".
"&& make install DESTDIR=$root");
x("mkdir -p $root/etc/php5/apache2/conf.d");
file_put_contents($root .'/etc/php5/apache2/conf.d/mapscript.ini', "; loading mapscript extension\n".
        "extension=/usr/lib/php5/20090626/php_mapscript.so");
x("cp -Rp $root/* $pwd/packager/root");
x("mkdir -p $root/usr/lib/cgi-bin && cp $root/usr/local/bin/mapserv $root/usr/lib/cgi-bin/");
//die();
