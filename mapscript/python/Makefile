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
PYTHON=
SWIG=

LTCC=$(LIBTOOL) --mode=compile --tag=CC
LTCXX=$(LIBTOOL) --mode=compile --tag=CXX
LTLD=$(LIBTOOL) --mode=link --tag=CXX
LTINSTALL=$(LIBTOOL) --mode=install

XTRALIBS=  -lm -ldl -lstdc++


PYLIBDIR=`$(PYTHON) -c "from distutils.sysconfig import get_python_lib; print get_python_lib(1)"`
PYINCDIR=`$(PYTHON) -c "from distutils.sysconfig import get_python_inc; print get_python_inc(1)"`

RUNPATH= -rpath $(PYLIBDIR)
DEFINES=    -DUSE_FASTCGI -DUSE_SVG_CAIRO -DUSE_CAIRO     -DUSE_WMS_LYR -DUSE_WFS_LYR -DUSE_SOS_SVR -DUSE_LIBXML2 -DUSE_CURL -DUSE_CURLOPT_PROXYAUTH -DUSE_KML  -DUSE_WCS_SVR -DUSE_WFS_SVR -DUSE_WMS_SVR   -DUSE_POSTGIS -DPOSTGIS_HAS_SERVER_VERSION -DUSE_GDAL -DUSE_OGR -DUSE_GEOS  -DHAVE_SYNC_FETCH_AND_ADD -DUSE_THREAD -DUSE_PROJ   -DUSE_GD  -DUSE_GD_PNG -DUSE_GD_JPEG -DUSE_GD_GIF -DUSE_ICONV -DUSE_JPEG -DUSE_GIF -DUSE_PNG -DUSE_FREETYPE -DHAVE_VSNPRINTF -DNEED_STRLCPY -DNEED_STRLCAT -DNEED_STRRSTR   -DDISABLE_CVSID
CFLAGS = $(DEFINES) -g    -Wall -Wdeclaration-after-statement  -I$(PYINCDIR) -I/opt/mapserver  -I/usr/include/cairo -I/usr/include/libxml2 -I/usr/include/glib-2.0 -I/usr/lib/x86_64-linux-gnu/glib-2.0/include -I/usr/include/pixman-1 -I/usr/include/freetype2 -I/usr/include/libpng12   -I/usr/include/cairo -I/usr/include/glib-2.0 -I/usr/lib/x86_64-linux-gnu/glib-2.0/include -I/usr/include/pixman-1 -I/usr/include/freetype2 -I/usr/include/libpng12      -I/usr/include/libxml2    -I/usr/include/postgresql -I/usr/include/gdal -I/usr/include      -I/usr/include/freetype2     

LT_LDFLAGS= $(RUNPATH) -module
OBJ_SUFFIX=lo
LINK=$(LTLD) $(LD) $(LT_LDFLAGS)
MS_LIB =   $(top_builddir)/libmapserver.la


.SUFFIXES:
.SUFFIXES: .cpp .c .$(OBJ_SUFFIX)

all: _mapscript.la

_mapscript.la: mapscript_wrap.lo pygdioctx/pygdioctx.lo $(MS_LIB)
	$(LINK) -o $@ mapscript_wrap.lo pygdioctx/pygdioctx.lo $(MS_LIB)

%.lo: %.c
	$(LTCC) $(CC) $(CFLAGS) -c -o $@ $<

mapscript_wrap.c: ../mapscript.i
	@test -n "$(SWIG)" || (echo "swig binary not found, cannot procede. install swig and rerun ./configure"; exit 1;)
	$(SWIG) -python -shadow -modern -templatereduce -fastdispatch -fvirtual -fastproxy -modernargs -castmode -dirvtable -fastinit -fastquery -noproxydel -nobuildnone $(DEFINES) -o mapscript_wrap.c ../mapscript.i

install-dirs:
	$(INSTALL) -d $(DESTDIR)$(PYLIBDIR)

install: install-dirs _mapscript.la
	$(LTINSTALL) $(INSTALL) _mapscript.la $(DESTDIR)$(PYLIBDIR)
	$(INSTALL) -c mapscript.py $(DESTDIR)$(PYLIBDIR)

clean:
	-rm -rf .libs *.lo *.la *.so *.o pygdioctx/.libs pygdioctx/*.o pygdioctx/*.lo mapscript_wrap.c mapscript.py

