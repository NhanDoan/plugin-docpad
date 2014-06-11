#! /bin/sh
#
# This script would install 
# 	- mysql 5.5
# 	- apache 2
# 	- php 5
# 	- and some modules
# @Date 2014/05/29
# @Author: NhanDoan
# @Email: nhan.doanngoc@asnet.com.vn

# update ubuntu OS
sudo apt-get update

# by pass asking the password while install mysql server
sudo echo "mysql-server-5.5 mysql-server/root_password password root" | sudo debconf-set-selections
sudo echo "mysql-server-5.5 mysql-server/root_password_again password root" | sudo debconf-set-selections

sudo apt-get install --force-yes --yes mysql-server
sudo apt-get install --force-yes --yes mysql-client-core-5.5

# install apache2
sudo apt-get install apache2 --force-yes --yes

# install notejs npm yo bower and docpad 
echo "--- Installing base packages ---"
sudo apt-get install --force-yes --yes vim git-core curl openssl python-software-properties 

echo "--- We want the bleeding edge of PHP, right master? ---"
sudo add-apt-repository -y ppa:ondrej/php5

echo "--- Updating packages list ---"
sudo apt-get update

echo "--- Installing and configuring Xdebug ---"
sudo apt-get install -y php5-xdebug

cat << EOF | sudo tee -a /etc/php5/mods-available/xdebug.ini
xdebug.scream=1
xdebug.cli_color=1
xdebug.show_local_vars=1
EOF
# install some module
sudo apt-get install php5 libapache2-mod-php5 --force-yes --yes
sudo apt-get install php5-mysql php5-curl php5-gd php5-intl php-pear php5-imagick php5-imap php5-mcrypt php5-memcache php5-ming php5-ps php5-pspell php5-recode php5-snmp php5-sqlite php5-tidy php5-xmlrpc php5-xsl --force-yes --yes

echo "--- Enabling mod-rewrite ---"
sudo a2enmod rewrite 

echo "--- Setting document root ---"
sudo rm -rf /var/www/html
sudo ln -fs /vagrant/www/* /var/www/

echo "--- What developer codes without errors turned on? Not you, master. ---"

sudo sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php5/apache2/php.ini
sudo sed -i "s/display_errors = .*/display_errors = On/" /etc/php5/apache2/php.ini

sudo sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

sudo sed -i 's/html/public/' /etc/apache2/sites-available/000-default.conf


echo "--- Installing node.js ---"
sudo apt-get update
sudo apt-get install -y  python g++ make
sudo add-apt-repository -y ppa:chris-lea/node.js
sudo apt-get update
sudo apt-get install -y  nodejs

sudo npm install -g npm --force-yes --yes
sudo chown -R $USER /usr/local ~/.npm
chmod -R 755 ~/.npm
sudo chown -R $USER:$GROUPS ~/tmp

sudo gem install compass

# install yo general docpad, general laravel , bower and grunt
sudo npm install yo bower grunt-cli generator-docpad generator-genlaravel -g

# install composer
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin
sudo ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

# modify the apache config for direct the document root to share folder
sudo cp -rf /vagrant/scripts/apache-config/default /etc/apache2/sites-available/default

# restart apache
sudo /etc/init.d/apache2 restart
 			