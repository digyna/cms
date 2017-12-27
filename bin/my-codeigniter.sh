#!/bin/sh

cd `dirname $0`
cd ..

composer update
DIRECTORIO=application
if [ ! -d $DIRECTORIO ]; then
    cp -r vendor/codeigniter/framework/application application
    echo "se han copiado los archivos a la raiz"
fi
cp -r vendor/codeigniter/framework/index.php index.php
sed -i "s/= 'system';/= 'vendor\/codeigniter\/framework\/system';/g" index.php
# Install translations
php bin/install.php translations develop