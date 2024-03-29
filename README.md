# What is MOSAVE?
MOSAVE is a web-based open-source personal savings application that has useful features such as creating a savings target and keeping track of after saving.

## Screenshots
![MoSave index page](https://ik.imagekit.io/bcdeh9gg1p3/MoSave/MoSave1_gmwUwz4KD.png)
![MoSave target page](https://ik.imagekit.io/bcdeh9gg1p3/MoSave/MoSave2_ur-H8Spl9.png)

## Features
* Authentication
* User Setting
* Make Target/Goal
* Save Money
* Saving History

## Installation on Local

* Make sure you have turned on Apache2 and MySQL
* Clone this repository to your local computer/server
* Rename the env file to .env
* Create new database with name mosave (can be changed in .env)
* Type this command in cli to install required dependencies: composer install (Note: You must install Composer first)
* Type this command in cli to migrations database: php spark migrate -all
* Type this command in cli to turn on local development server: php spark serve

If you get an error from the database, change the database.default.hostname in the **env** file from 127.0.0.1 to localhost and make sure to enable sqlite3 extensions in php.ini

## Server Requirements

PHP version 7.3 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)
