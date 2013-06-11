# $Id$
#
# Run ./configure in the main MapServer directory to turn this Makefile.in
# into a proper Makefile

#
# If you want to ignore missing datafile errors uncomment the following
# line. This is especially useful with large tiled datasets that may not
# have complete data for each tile.
#
#IGNORE_MISSING_DATA=-DIGNORE_MISSING_DATA
IGNORE_MISSING_DATA = 

#
# If you want to use shape Z and M parameter this option must be set.
# It's OFF by default.
#
#USE_POINT_Z_M=-DUSE_POINT_Z_M
USE_POINT_Z_M = 

#
# Apparently these aren't as commonplace as I'd hoped. Edit the
# following line to reflect the missing functions on your platform.
#
# STRINGS=-DNEED_STRCASECMP -DNEED_STRNCASECMP -DNEED_STRDUP -DNEED_STRLCAT
STRINGS= -DHAVE_VSNPRINTF -DNEED_STRLCPY -DNEED_STRLCAT -DNEED_STRRSTR 

#
# Flags.
#

XTRALIBS=  -lm -ldl -lstdc++
RUNPATHS=  /opt/mapserver

FLAGS =      -DUSE_FASTCGI -DUSE_SVG_CAIRO -DUSE_CAIRO     -DUSE_WMS_LYR -DUSE_WFS_LYR -DUSE_SOS_SVR -DUSE_LIBXML2 -DUSE_CURL -DUSE_CURLOPT_PROXYAUTH -DUSE_KML  -DUSE_WCS_SVR -DUSE_WFS_SVR -DUSE_WMS_SVR   -DUSE_POSTGIS -DPOSTGIS_HAS_SERVER_VERSION -DUSE_GDAL -DUSE_OGR -DUSE_GEOS  -DHAVE_SYNC_FETCH_AND_ADD -DUSE_THREAD -DUSE_PROJ   -DUSE_GD  -DUSE_GD_PNG -DUSE_GD_JPEG -DUSE_GD_GIF -DUSE_ICONV -DUSE_JPEG -DUSE_GIF -DUSE_PNG -DUSE_FREETYPE -DHAVE_VSNPRINTF -DNEED_STRLCPY -DNEED_STRLCAT -DNEED_STRRSTR   -DDISABLE_CVSID  -I/usr/include/cairo -I/usr/include/libxml2 -I/usr/include/glib-2.0 -I/usr/lib/x86_64-linux-gnu/glib-2.0/include -I/usr/include/pixman-1 -I/usr/include/freetype2 -I/usr/include/libpng12   -I/usr/include/cairo -I/usr/include/glib-2.0 -I/usr/lib/x86_64-linux-gnu/glib-2.0/include -I/usr/include/pixman-1 -I/usr/include/freetype2 -I/usr/include/libpng12      -I/usr/include/libxml2    -I/usr/include/postgresql -I/usr/include/gdal -I/usr/include      -I/usr/include/freetype2      $(STRINGS) $(IGNORE_MISSING_DATA) $(USE_POINT_Z_M)

CCFLAGS   = -g    -Wall -Wdeclaration-after-statement  $(FLAGS)

# Link flags and shared libs only
SUP_LIBS =  -lfcgi -lsvg-cairo -lsvg -lpng -ljpeg -lz -lcairo -lxml2   -lfreetype -lz -lcairo -lpng12      -L/usr/lib -lxml2 -L/usr/lib/x86_64-linux-gnu -lcurl -Wl,-Bsymbolic-functions -Wl,-z,relro   -L/usr/lib -lpq -L/usr/lib -lgdal -L/usr/lib -lgeos_c  -lpthread -lproj   -lc -L/usr/lib/x86_64-linux-gnu -lfreetype -lz   -lpng  -lgif  -ljpeg -L/usr/lib/x86_64-linux-gnu -lgd

# STATIC_LIBS is full filename with path of libs that will be statically linked
STATIC_LIBS= $(GD_STATIC)

LDFLAGS= $(RUNPATHS) -L../.. -lmapserver $(SUP_LIBS) $(STATIC_LIBS)

LIBMAPSCRIPT_SHARED= libmapscript.so
LD_SHARED= g++ -shared 

# END OF CONFIGURE----

#
# SWIG Stuff
#
SWIG= swig

#
# CSHARP Stuff
#
CSC= mcs

CC= gcc

#
# --- You shouldn't have to edit anything else. ---
#
all: interface mapscript_so mapscript_csharp

sign:
	sn -k mapscript.snk

interface: ../mapscript.i
	$(SWIG) -csharp -namespace OSGeo.MapServer $(FLAGS) -o mapscript_wrap.c ../mapscript.i

mapscript_so: mapscript_wrap.c
	$(CC) -fpic -c $(CCFLAGS) mapscript_wrap.c
	$(LD_SHARED) mapscript_wrap.o -o $(LIBMAPSCRIPT_SHARED) $(LDFLAGS)

mapscript_csharp::
	$(CSC) /t:library /out:mapscript_csharp.dll *.cs config/AssemblyInfo.cs
	$(CSC) /r:mapscript_csharp.dll /out:shpdump.exe examples/shpdump.cs
	$(CSC) /r:mapscript_csharp.dll /out:shapeinfo.exe examples/shapeinfo.cs
	$(CSC) /r:mapscript_csharp.dll /out:drawmap.exe examples/drawmap.cs
	$(CSC) /r:mapscript_csharp.dll /out:inline.exe examples/inline.cs
	$(CSC) /r:mapscript_csharp.dll /out:drawquery.exe examples/drawquery.cs
	$(CSC) /r:mapscript_csharp.dll /r:System.Drawing.dll /out:getbytes.exe examples/getbytes.cs
	$(CSC) /r:mapscript_csharp.dll /out:HTMLtemplate.exe examples/HTMLtemplate.cs
	$(CSC) /r:mapscript_csharp.dll /out:RFC24.exe examples/RFC24.cs

dll_config: Makefile
	rm -rf mapscript_csharp.dll.config
	echo "<configuration>" >> mapscript_csharp.dll.config
	echo "<dllmap dll=\"mapscript\" target=\""mapscript"\">" >> mapscript_csharp.dll.config
	echo "</configuration>" >> mapscript_csharp.dll.config

clean:
	rm -rf edu *.o *.c *.cs *.so *.dll *.dll.config

test:
	LC_ALL=C mono ./shpdump.exe ../../tests/point.shp
	LC_ALL=C mono ./shapeinfo.exe ../../tests/point.shp
	LC_ALL=C mono ./inline.exe png24 inline_test.png
	LC_ALL=C mono ./getbytes.exe ../../tests/test.map test_csharp2.png
	LC_ALL=C mono ./RFC24.exe ../../tests/test.map

