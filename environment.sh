
#!/bin/sh
# This is some secure program that uses security.

ENV_DEV="dev" #this is our enviroment development.
ENV_PROD="prod" #this is our enviroment production.
echo "Please enter environment you want to building(prod or dev)"
read ENV

if [ "$ENV" == "$ENV_PROD" ]; then
        cd /vagrant/www
        grunt build-prod
else
        cd /vagrant/www
        grunt build-dev
fi