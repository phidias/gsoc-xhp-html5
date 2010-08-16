#!/bin/bash
ARCHIVE="xhp-html5-1.0"
echo $ARCHIVE

rm -rf $ARCHIVE
rm $ARCHIVE.tar.gz
rm $ARCHIVE.zip

mkdir $ARCHIVE

mkdir $ARCHIVE/php-lib
cp php-lib/core.php $ARCHIVE/php-lib/
cp php-lib/html5.php $ARCHIVE/php-lib/
cp php-lib/init.php $ARCHIVE/php-lib

mkdir $ARCHIVE/res
cp res/*.js $ARCHIVE/res/
cp res/*.css $ARCHIVE/res/
cp -rf res/colorpicker $ARCHIVE/res/
cp -rf res/timepicker $ARCHIVE/res/

mkdir $ARCHIVE/res/jquery-ui
cp -rf res/jquery-ui/css $ARCHIVE/res/jquery-ui/
cp -rf res/jquery-ui/js $ARCHIVE/res/jquery-ui/

tar -cf $ARCHIVE.tar $ARCHIVE
gzip $ARCHIVE.tar
zip -r $ARCHIVE.zip $ARCHIVE
rm -rf $ARCHIVE
