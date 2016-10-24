PacificNM
=======================

Introduction
------------
This is the core Pacificnm Open Source project. This code will always be free to any one who wants to use it, try it, build from it
what ever works. I use several other peoples Open Source Projects please pay them attention. With out them I could of never done this.
Theres a list of all projects on the about page.
 
The front end: https://github.com/almasaeed2010/AdminLTE

The Application: https://github.com/zendframework/ZendSkeletonApplication

Ok I guess its time to start documenting how to install. The end goal would be a docker container that can just be spwaned in Elastic Bean Stalk 
or just create a EC2 image when a new user registers.

This app is built from the Zend Framework Skeleton so follow that for the main framework and basic guts.

Installation using Composer
---------------------------

Once the code is checked out you have run composer --install
This will grab all the dependencies and set up linking.

Web server setup
----------------
### Folders ###
Initiall set all folders to owner of web server such as www-data or apache. After the system is up the only folder 
that needs write access is data. None of the other folders need to have write access nor do we want to. Do not store 
anything in public keep it in data. 

All Client File uploads are stored in data/files/client/clientId
From there work order related files are stored in sub folder workorder
Client files will be in their root.


### PHP CLI server

The simplest way to get started if you are using PHP 5.4 or above is to start the internal PHP cli-server in the root
directory:

    php -S 0.0.0.0:8080 -t public/ public/index.php

This will start the cli-server on port 8080, and bind it to all network
interfaces.

**Note:** The built-in CLI server is *for development only*.

### Vagrant server

This project supports a basic [Vagrant](http://docs.vagrantup.com/v2/getting-started/index.html) configuration with an inline shell provisioner to run the Skeleton Application in a [VirtualBox](https://www.virtualbox.org/wiki/Downloads).

1. Run vagrant up command

    vagrant up

2. Visit [http://localhost:8085](http://localhost:8085) in your browser

Look in [Vagrantfile](Vagrantfile) for configuration details.

### Apache setup

To setup apache, setup a virtual host to point to the public/ directory of the
project and you should be ready to go! It should look something like below:

    <VirtualHost *:80>
        ServerName zf2-app.localhost
        DocumentRoot /path/to/zf2-app/public
        <Directory /path/to/zf2-app/public>
            DirectoryIndex index.php
            AllowOverride All
            Order allow,deny
            Allow from all
            <IfModule mod_authz_core.c>
            Require all granted
            </IfModule>
        </Directory>
    </VirtualHost>


Cron setup
----------------
The sytem needs to run one cron job that will runevery min through cron.
This script then checks for what ever application cron jobs need to be ran. 
This is configured through the admin in the cron section.

To set it up run crontab -e as root and past the following code.

	*/1   *    *    *    *     /var/www/bin/console.php cron --run

On the system /var/www/bin/console.php should be a symlink to your install ie: /var/www/html/pnm/bin/console.php
We create the symlink in case it moves or something changes we dont have to update the cron tab.

