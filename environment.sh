
#!/bin/bash
# This is some secure program that uses security.

ENV=$1
sudo rm -rf /var/www/*

sudo ln -s `pwd`/www/* /var/www

cd www
composer update
npm install
bower install --force-yes --yes

sudo /etc/init.d/apache2 restart

ENV_DEV="dev" #this is our enviroment development.
ENV_PROD="prod" #this is our enviroment production.


if [ "$ENV" == "$ENV_PROD" ]; then
        grunt build-prod
else
        grunt build-dev	
fi