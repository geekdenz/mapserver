# Run ./configure in the main MapServer directory to turn this Makefile.in
# into a proper Makefile

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
SWIG=swig

#
# MS_VERSION - Set by configure based in mapserver.h
#
MS_VERSION=	6.2.1

#
# Java Stuff
#
JAVADOC=javadoc
JAVAC=javac
JAVA=java
JAR=jar
JAVA_INCLUDE=

LTCC=$(LIBTOOL) --mode=compile --tag=CC
LTCXX=$(LIBTOOL) --mode=compile --tag=CXX
LTLD=$(LIBTOOL) --mode=link --tag=CXX
LTINSTALL=$(LIBTOOL) --mode=install

XTRALIBS=  -lm -ldl -lstdc++

RUNPATH= -rpath $(libdir)
DEFINES=    -DUSE_FASTCGI -DUSE_SVG_CAIRO -DUSE_CAIRO     -DUSE_WMS_LYR -DUSE_WFS_LYR -DUSE_SOS_SVR -DUSE_LIBXML2 -DUSE_CURL -DUSE_CURLOPT_PROXYAUTH -DUSE_KML  -DUSE_WCS_SVR -DUSE_WFS_SVR -DUSE_WMS_SVR   -DUSE_POSTGIS -DPOSTGIS_HAS_SERVER_VERSION -DUSE_GDAL -DUSE_OGR -DUSE_GEOS  -DHAVE_SYNC_FETCH_AND_ADD -DUSE_THREAD -DUSE_PROJ   -DUSE_GD  -DUSE_GD_PNG -DUSE_GD_JPEG -DUSE_GD_GIF -DUSE_ICONV -DUSE_JPEG -DUSE_GIF -DUSE_PNG -DUSE_FREETYPE -DHAVE_VSNPRINTF -DNEED_STRLCPY -DNEED_STRLCAT -DNEED_STRRSTR   -DDISABLE_CVSID
CFLAGS = $(DEFINES) -g    -Wall -Wdeclaration-after-statement  -I$(PYINCDIR) -I/opt/mapserver  -I/usr/include/cairo -I/usr/include/libxml2 -I/usr/include/glib-2.0 -I/usr/lib/x86_64-linux-gnu/glib-2.0/include -I/usr/include/pixman-1 -I/usr/include/freetype2 -I/usr/include/libpng12   -I/usr/include/cairo -I/usr/include/glib-2.0 -I/usr/lib/x86_64-linux-gnu/glib-2.0/include -I/usr/include/pixman-1 -I/usr/include/freetype2 -I/usr/include/libpng12      -I/usr/include/libxml2    -I/usr/include/postgresql -I/usr/include/gdal -I/usr/include      -I/usr/include/freetype2     

LT_LDFLAGS= $(RUNPATH) -module
OBJ_SUFFIX=lo
LINK=$(LTLD) $(LD) $(LT_LDFLAGS)
MS_LIB =   $(top_builddir)/libmapserver.la


.SUFFIXES:
.SUFFIXES: .cpp .c .$(OBJ_SUFFIX)

all: javamapscript.jar

libjavamapscript.la: javamapscript_wrap.lo $(MS_LIB)
	$(LINK) -release $(MS_VERSION) -o $@ javamapscript_wrap.lo $(MS_LIB)

%.lo: %.c
	$(LTCC) $(CC) -fno-strict-aliasing -fpic -c $(CFLAGS) $(JAVA_INCLUDE) -c -o $@ $<

javamapscript_wrap.c: ../mapscript.i
	mkdir -p edu/umn/gis/mapscript 
	$(SWIG) -java -package edu.umn.gis.mapscript $(DEFINES) -outdir edu/umn/gis/mapscript -o javamapscript_wrap.c ../mapscript.i

javamapscript_java: javamapscript_wrap.c
	$(JAVAC) edu/umn/gis/mapscript/*.java

mapscript_javadoc: javamapscript_wrap.c
	$(JAVADOC) -d doc -sourcepath edu/umn/gis/mapscript/*.java

javamapscript.jar: javamapscript_java libjavamapscript.la
	$(JAR) cf mapscript.jar edu

install: mapscript.jar
	$(LTINSTALL) $(INSTALL) libjavamapscript.la $(DESTDIR)$(libdir)

clean:
	-rm -rf .libs *.lo *.la *.so *.o pygdioctx/*.o pygdioctx/*.lo
	rm -rf edu *.o *.c *.so *.java *.jar *.png
	rm -rf examples/*.class
	rm -rf tests/threadtest/*.class


ifneq ($(findstring PROJ, $(DEFINES)),)
ifneq ($(findstring GDAL, $(DEFINES)),)
test:
	$(JAVAC) -classpath ./:examples/:./mapscript.jar -d examples/ examples/RFC24.java examples/ConnPool.java examples/DrawMap.java examples/DumpShp.java examples/MakePoint.java examples/QueryByAttribute.java examples/ShapeInfo.java examples/WxSTest.java examples/Metadata.java examples/RunTimeBuiltWMSClient.java
	$(JAVAC) -encoding utf8 -classpath ./:examples/:./mapscript.jar -d examples/ examples/QueryByAttributeUnicode.java 
	$(JAVA) -classpath ./:examples/:./mapscript.jar -Djava.library.path=.libs/ DumpShp ../../tests/point.shp
	$(JAVA) -classpath ./:examples/:./mapscript.jar -Djava.library.path=.libs/ ShapeInfo ../../tests/point.shp ../../tests/point.dbf
	$(JAVA) -classpath ./:examples/:./mapscript.jar -Djava.library.path=.libs/ DrawMap ../../tests/test.map ./map.png
	$(JAVA) -classpath ./:examples/:./mapscript.jar -Djava.library.path=.libs/ ConnPool
	$(JAVA) -classpath ./:examples/:./mapscript.jar -Djava.library.path=.libs/ QueryByAttribute ../../tests/test.map
ifneq ($(findstring USE_WCS_SVR, $(DEFINES)),)
	$(JAVA) -classpath ./:examples/:./mapscript.jar -Djava.library.path=.libs/ WxSTest ../../tests/test.map
else
	@echo "WARN: Skipping WxSTest because OWS is not enabled"
endif
	$(JAVA) -classpath ./:examples/:./mapscript.jar -Djava.library.path=.libs/ RFC24 ../../tests/test.map
	LC_ALL=en_US.UTF-8 $(JAVA) -classpath ./:examples/:./mapscript.jar -Djava.library.path=.libs/ QueryByAttributeUnicode data/subset-umlauts.map
else
test:
	@echo "To run the tests GDAL and PROJ must be enabled"
endif
else
test:
	@echo "To run the tests GDAL and PROJ must be enabled"
endif

threadtests:
	$(JAVAC) -cp ./mapscript.jar -d tests/threadtest/ tests/threadtest/*.java
	@echo "-------------------------------------------------------------------------"
	@echo "   You can use your own map! Copy the following command in your shell"
	@echo "        and change the file to the map file (the last argument)"
	@echo "-------------------------------------------------------------------------"
	$(JAVA) -Djava.library.path=./ -Djava.library.path=.libs/ -cp tests/threadtest/:./mapscript.jar MapTest -t 10 -i 5 ../../tests/test.map

