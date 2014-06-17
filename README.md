# http://ec2-54-187-62-166.us-west-2.compute.amazonaws.com

## Project structure

1. www
All contains application of project

2. Vagrant (/vagrant)
Contains scripts & config file for [vagrant](http://www.vagrantup.com/)

## Getting Started

1. [Install VirtualBox](https://www.virtualbox.org/wiki/Downloads) version 4.3.3

2. [Install Vagrant](http://www.vagrantup.com/downloads.html) Latest (tested with 1.3.5)

3. Clone the project and do `vagrant up --provision`

  ```
  vagrant up --provision

  **Note: if you see error: /bin/sh^M : bad interpreter

    Pls work step by step follow:
      1. vagrant ssh
      2. sudo sed -i 's/\r//' /vagrant/scripts/install-soft.sh
      3. exit
      4. vagrant reload --provision
  ```

4. SSH to the vagrant box

  ```
  vagrant ssh
  ```

## Run application

1. Install package and vendor application

  ```
  cd /vagrant/www
  composer update
  sudo npm install -d
  bower update
  ```

2. Run project with enviroment development or production
  
  ```
  cd /vagrant
  ./environment.sh
  Note: - If you want to building project with environment production. Please ENTER: prod
        - If you want to building project with environment production. Please ENTER: dev

  ```
