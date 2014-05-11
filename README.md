Sportlobster API v3
===================

This is the repository for the version 3 of the Sportlobster API.
The API is build on top of Symfony2 framework and requires MySQL, MongoDB and Memcached.
To ease the environment setup, it is included the configuration of a Vagrant virtual machine in the vagrant directory.

Virtual Machine
---------------

* Make sure you have installed the following

    * VirtualBox 4.2.20 [1]
    * Vagrant 1.6.1 [2]
    * Vagrant Berkshelf plugin 2.0.1 [3]
    * Vagrant Omnibus plugin 1.4.1 [4]
    * Ruby 2.0.0p353 (recommended to use rbenv) [5]

* Boot up the vagrant virtual machine running the following command from inside the vagrant directory

    $ cd vagrant
    $ vagrant up

* Connect to the machine

    $ vagrant ssh

* The project is located at /projects/api in the virtual machine

    $ cd /projects/api

* Create the database and run the migrations and fixtures

    $ php app/console doctrine:database:create 
    $ php app/console doctrine:migrations:migrate 
    $ php app/console doctrine:fixtures:run

* Make sure all the tests are green

    $ ./bin/phpunit -c app
    $ ./bin/behat

* Configure your local /etc/hosts to map the IP 33.33.33.100 to api.sportlobster.dev

* On your local machine's browser, visit http://api.sportlobster.dev/api/doc

[1] https://www.virtualbox.org/wiki/Downloads
[2] http://www.vagrantup.com/
[3] http://berkshelf.com/
[4] https://github.com/schisamo/vagrant-omnibus
[5] https://github.com/sstephenson/rbenv