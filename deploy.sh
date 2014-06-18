
#!/bin/bash
# This is some secure program that uses security.

ENV=$1

# cd www to update package and composer update for application
cd www

composer update
npm install
bower install --force-yes --yes

# return folder root and symlink into 

sudo rm -rf /var/www/*
sudo ln -s `pwd`/* /var/www
sudo /etc/init.d/apache2 restart
chmod -R 777 /app/storage
ENV_DEV="dev" #this is our enviroment development.
ENV_PROD="prod" #this is our enviroment production.


if [ "$ENV" == "$ENV_PROD" ]; then
        grunt build-prod
else
        grunt build-dev	
fi

