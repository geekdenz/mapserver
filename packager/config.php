<?php
return array(
    'landcare-mapserver' => array(
        'before-package' => 'before-package.php', // gets executed after the setup and before the actual package build
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
            'libgeos-3.2.2',
            'libsvg-cairo',
            'libgdal1',
            'libsvg-cairo',
            'php5',
        ),
        'description' => 'MapServer is a WMS implementing applications with GeoSpatial features.',
        'files' => array(
            'build/*' => '/',
        ),
        'license' => 'GPL v3',
        'repository' => 'repository.test.zen.landcareresearch.co.nz:/var/www/dists/precise/main/binary-amd64',
        'url' => 'http://mapserver.org',
        'vendor' => 'Regents of the University of Minnesota & Landcare Research',

        'm' => 'heuert@landcareresearch.co.nz',
        's' => 'dir',
        't' => 'deb', // this can probably be rpm as well, but I haven't tried
    ),
);
