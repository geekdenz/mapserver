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
);
x("sudo apt-get install -y ". implode(' ', $apt_deps));
e("Compiling MapServer...");
x("mkdir build");
$prefix = "'". trim(`pwd`) ."/build'";
x("./configure --enable-debug --with-proj --with-geos --with-gdal ".//=/usr/local/bin/gdal-config ".
    "--with-ogr --with-postgis --with-cairo --with-wmsclient --with-wfs --with-wfsclient --with-wcs --with-curl-config ".
    "--with-xml2-config --with-sos --with-fastcgi --with-freetype --with-gd --with-jpeg --with-png --with-kml --with-threads ".
    "--with-libsvg-cairo --with-php=/usr/bin/php-config ".
    "&& make clean && make && make install DESTDIR=$prefix && echo SUCCESSFULLY COMPILED");
x("mkdir -p $prefix/etc/php5/apache2/conf.d");
file_put_contents($prefix .'/etc/php5/apache2/conf.d/mapscript.ini', "; loading mapscript extension\n".
        "extension=/usr/lib/php5/20090626/php_mapscript-6.2.1.so");
