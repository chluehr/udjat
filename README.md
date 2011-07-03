Udjat Monitoring
================

Warning
-------

Work-In-Progress! This project is currently not in a working state!

Requirements
------------

* PHP 5.3+
* mongoDb (sudo apt-get install mongodb)
* PHP mongo pecl extension (sudo pecl install mongo)
* Apache / mod_rewrite (sudo a2enmod rewrite)

Installation
------------

Monitor / Server:

* set up a (virtual) host for you webserver, pointing at the htdocs folder
* allow .htaccess files (needed for dynamic rewrite rules)

Client:

* transfer the "client" directory to all systems in need of monitoring
* copy udjat.conf.dist to udjat.conf and change the url accordingly
* add a cronjob, 5 minute interval:

>  */5 * * * * /ABSOLUTE_PATH_TO_CLIENT_DIRECTORY/client/udjat.sh 2>&1 >/dev/null


Usage
-----

3rd Party Code
--------------

* http://www.jqplot.com/ (Version 1.0.0b1_r746)
* http://www.phpMoAdmin.com (for simple debugging during development)
* Janrain social login

Credits
-------

* HTML template based on Redmine Issue Tracker
* Default theme based on Redmine Basecamp template