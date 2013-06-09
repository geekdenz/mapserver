<?php
return array(
    'landcare-mapserver' => array(
        //'before-package' => 'before-package.php', // gets executed after the setup and before the actual package build
        'depends' => array( // list of dependencies
            'php5-cli',
            'libfreetype6',
            'libpng12-0',
            'libproj0',
            'libgif4',
            'zlib-bin',
            'libgd-tools',
            'libcairo2',
            'libfcgi0ldbl',
            'libxml2',
            'libgd2-xpm',
            'libgeos-3.2.2',//'libgeos-dev',
            //'',//'libghc6-svgcairo-dev',
            'libgdal1-1.7.0',//'libgdal-dev',
            //'libgdal1-dev',
            //'libghc-svgcairo-dev',
            'libsvg-cairo',
            //'libcurl4-gnutls-dev',
            //'php5-dev',
            'php5',
            //'libghc-svgcairo-dev',
            //'gcc',
            //'make',
        ),
        'description' => 'MapServer is a WMS implementing applications with GeoSpatial features.',
        'files' => array(
            //'*' => '/usr/local/php-packager/',
            //'packager/*' => '/usr/local/php-packager/packager/
            'build/*' => '/',
            ////'/usr/lib/libsvg-cairo.so.1' => '/usr/lib/libsvg-cairo.so.1',
            //'/usr/lib/libsvg-cairo.so.1.0.1' => '/usr/lib/libsvg-cairo.so.1',
            //'/usr/lib/libsvg.so.1.0.0' => '/usr/lib/libsvg.so.1',
        ),
        'license' => 'GPL v3',
        //'user' => 'heuert', // optional. The user to upload the deb package, `whoami` by default
        //'repository' => 'repository.test:/var/www/dists/stable/main/binary-amd64', // ssh url of repository to put this in
        'repository' => 'repository.test.zen.landcareresearch.co.nz:/var/www/dists/precise/main/binary-amd64',
        'url' => 'http://mapserver.org',
        'vendor' => 'Regents of the University of Minnesota & Landcare Research',

        'm' => 'heuert@landcareresearch.co.nz',
        's' => 'dir',
        't' => 'deb', // this can probably be rpm as well, but I haven't tried
    ),
);
