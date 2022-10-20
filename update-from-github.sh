#! /bin/sh
echo "Update dari https://github.com/irev/absenonline"
read -r -p "Lanjutkan update script absensionline ? [y/n]" lanjut 
if [ "$lanjt" = 'y']
then
echo " Ok mulai update "
rm -r /var/www/absenonline
git clone https://github.com/irev/absenonline.git 
cp -rf /var/www/absenonline/* /var/www/html
fi
