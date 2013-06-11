# Run ./configure in the main MapServer directory to turn this Makefile.in
# into a proper Makefile

#
# This is an adapted version of php-3.0.14/dl/Makefile.tmpl for the 
# MapServer php_mapscript.so module.
#
# $Id$
#

# +----------------------------------------------------------------------+
# | PHP HTML Embedded Scripting Language Version 3.0                     |
# +----------------------------------------------------------------------+
# | Copyright (c) 1997,1998 PHP Development Team (See Credits file)      |
# +----------------------------------------------------------------------+
# | This program is free software; you can redistribute it and/or modify |
# | it under the terms of one of the following licenses:                 |
# |                                                                      |
# |  A) the GNU General Public License as published by the Free Software |
# |     Foundation; either version 2 of the License, or (at your option) |
# |     any later version.                                               |
# |                                                                      |
# |  B) the PHP License as published by the PHP Development Team and     |
# |     included in the distribution in the file: LICENSE                |
# |                                                                      |
# | This program is distributed in the hope that it will be useful,      |
# | but WITHOUT ANY WARRANTY; without even the implied warranty of       |
# | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the        |
# | GNU General Public License for more details.                         |
# |                                                                      |
# | You should have received a copy of both licenses referred to here.   |
# | If you did not, or have any questions about PHP licensing, please    |
# | contact core@php.net.                                                |
# +----------------------------------------------------------------------+

#
# Pick a compiler, etc. Flex and bison are only required if you need to modify the mapserver lexer (maplexer.l) or expression parser (mapparser.y).
#
prefix		=	/usr/local
exec_prefix	=	${prefix}
libdir	=	${exec_prefix}/lib
bindir	=	${exec_prefix}/bin
top_builddir = ../..
SHELL = /bin/bash
CXX=	g++
CC=     gcc
LD=     g++
LIBTOOL=$(SHELL) $(top_builddir)/libtool
INSTALL=/usr/bin/install -c
PHPCONFIG=/usr/bin/php-config

LTCC=$(LIBTOOL) --mode=compile --tag=CC
LTCXX=$(LIBTOOL) --mode=compile --tag=CXX
LTLD=$(LIBTOOL) --mode=link --tag=CXX
LTINSTALL=$(LIBTOOL) --mode=install

XTRALIBS=  -lm -ldl -lstdc++
RUNPATHS= -rpath $(libdir)

CFLAGS = -g    -Wall -Wdeclaration-after-statement  -DUSE_PHP_REGEX -DCOMPILE_DL=1 -DPHP_VERSION_ID=50310


PHP_INC = `$(PHPCONFIG) --includes ` 

#
# IMPORTANT NOTE ABOUT REGEX FOR PHP_MAPSCRIPT USERS:
#
# In order to compile the PHP_MAPSCRIPT module, we have to make MapServer
# uses the same version of the REGEX library that PHP was compiled with:
#
PHP_REGEX_OBJ=php_regex.lo
PHP_REGEX_INC=-I/usr/include/php5/ext/ereg/


#
# Set MapServer extensions parameters.  See main MapServer Makefile for 
# more details... 
# Common defaults are:
# MS_DEFINE = -DUSE_TTF -DUSE_TIFF -DUSE_EPPL -DUSE_GD_1_2
# MS_INCLUDE = -I../.. -I../../gd-1.2 -I../../gdft
# MS_LIBS = -L../.. -lmap -L../../gdft -lgdft -ltiff -lttf -L../../gd-1.2 -lgd
#
MS_DEFINE =     -DUSE_FASTCGI -DUSE_SVG_CAIRO -DUSE_CAIRO     -DUSE_WMS_LYR -DUSE_WFS_LYR -DUSE_SOS_SVR -DUSE_LIBXML2 -DUSE_CURL -DUSE_CURLOPT_PROXYAUTH -DUSE_KML  -DUSE_WCS_SVR -DUSE_WFS_SVR -DUSE_WMS_SVR   -DUSE_POSTGIS -DPOSTGIS_HAS_SERVER_VERSION -DUSE_GDAL -DUSE_OGR -DUSE_GEOS  -DHAVE_SYNC_FETCH_AND_ADD -DUSE_THREAD -DUSE_PROJ   -DUSE_GD  -DUSE_GD_PNG -DUSE_GD_JPEG -DUSE_GD_GIF -DUSE_ICONV -DUSE_JPEG -DUSE_GIF -DUSE_PNG -DUSE_FREETYPE -DHAVE_VSNPRINTF -DNEED_STRLCPY -DNEED_STRLCAT -DNEED_STRRSTR   -DDISABLE_CVSID
MS_INC =    -I/opt/mapserver  -I/usr/include/cairo -I/usr/include/libxml2 -I/usr/include/glib-2.0 -I/usr/lib/x86_64-linux-gnu/glib-2.0/include -I/usr/include/pixman-1 -I/usr/include/freetype2 -I/usr/include/libpng12   -I/usr/include/cairo -I/usr/include/glib-2.0 -I/usr/lib/x86_64-linux-gnu/glib-2.0/include -I/usr/include/pixman-1 -I/usr/include/freetype2 -I/usr/include/libpng12      -I/usr/include/libxml2    -I/usr/include/postgresql -I/usr/include/gdal -I/usr/include      -I/usr/include/freetype2     
MS_STATIC = 
MS_LIBS =   $(RUNPATHS) -L/opt/mapserver -lmapserver -lfcgi -lsvg-cairo -lsvg -lpng -ljpeg -lz -lcairo -lxml2   -lfreetype -lz -lcairo -lpng12      -L/usr/lib -lxml2 -L/usr/lib/x86_64-linux-gnu -lcurl -Wl,-Bsymbolic-functions -Wl,-z,relro   -L/usr/lib -lpq -L/usr/lib -lgdal -L/usr/lib -lgeos_c  -lpthread -lproj   -lc -L/usr/lib/x86_64-linux-gnu -lfreetype -lz   -lpng  -lgif  -ljpeg -L/usr/lib/x86_64-linux-gnu -lgd  -lm -ldl -lstdc++ $(MS_STATIC)
PHP_EXT_DIR=`$(PHPCONFIG) --extension-dir`

LT_LDFLAGS=-rpath $(PHP_EXT_DIR) -module
OBJ_SUFFIX=lo
LINK=$(LTLD) $(LD) $(LT_LDFLAGS)
MS_LIBS =   ../../libmapserver.la

MS_VERSION = 6.2.1

#
# The rest of the file should not have to be edited...
#

CFLAGS112 = $(CFLAGS) $(MS_DEFINE) $(MS_INC) $(PHP_INC) $(PHP_REGEX_INC)

.SUFFIXES:
.SUFFIXES: .cpp .c .$(OBJ_SUFFIX)

all: php_mapscript.la

PHPMS_CLASS_OBJS =  mapscript_error.$(OBJ_SUFFIX) color.$(OBJ_SUFFIX) rect.$(OBJ_SUFFIX) hashtable.$(OBJ_SUFFIX) web.$(OBJ_SUFFIX) grid.$(OBJ_SUFFIX) error.$(OBJ_SUFFIX)\
						  referencemap.$(OBJ_SUFFIX) querymap.$(OBJ_SUFFIX) outputformat.$(OBJ_SUFFIX) scalebar.$(OBJ_SUFFIX) label.$(OBJ_SUFFIX) legend.$(OBJ_SUFFIX)\
						  symbol.$(OBJ_SUFFIX) style.$(OBJ_SUFFIX) image.$(OBJ_SUFFIX) class.$(OBJ_SUFFIX) projection.$(OBJ_SUFFIX) line.$(OBJ_SUFFIX) shape.$(OBJ_SUFFIX) shapefile.$(OBJ_SUFFIX)\
						  point.$(OBJ_SUFFIX) labelcache.$(OBJ_SUFFIX) labelleader.$(OBJ_SUFFIX) labelcachemember.$(OBJ_SUFFIX) result.$(OBJ_SUFFIX) owsrequest.$(OBJ_SUFFIX) cluster.$(OBJ_SUFFIX)\
						  layer.$(OBJ_SUFFIX) map.$(OBJ_SUFFIX)
PHPMS_OBJS =  php_mapscript_util.$(OBJ_SUFFIX) $(PHPMS_CLASS_OBJS) php_mapscript.$(OBJ_SUFFIX) mapscript_i.$(OBJ_SUFFIX)\
				  $(PHP_REGEX_OBJ)

PHPPROJ_OBJS = php_mapscript_util.$(OBJ_SUFFIX) php_proj.$(OBJ_SUFFIX) $(PHP_REGEX_OBJ)


php_mapscript.la: $(PHPMS_OBJS) ../../libmapserver.la
	$(LINK) -release $(MS_VERSION) -o $@ $(PHPMS_OBJS) $(MS_LIBS)

php_proj.la:  $(PHPPROJ_OBJS) ../libmapserver.la
	$(LINK) -release $(MS_VERSION) -o $@ $(PHPPROJ_OBJS) $(MS_LIBS)

%.lo: %.c php_mapscript_util.h php_mapscript.h
	$(LTCC) $(CC) $(CFLAGS112) -c -o $@ $<

install: php_mapscript.la
	$(INSTALL) -d $(DESTDIR)$(PHP_EXT_DIR)
	$(LTINSTALL) $(INSTALL) php_mapscript.la $(DESTDIR)$(PHP_EXT_DIR)

clean:
	-rm -rf .libs *.lo *.la *.so *.o perl.out

