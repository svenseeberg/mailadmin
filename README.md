# mailadmin
Admin GUI for a Postfix+Dovecot mail server based on https://thomas-leister.de/mailserver-debian-stretch/.
These scripts can be run on a classic LAMP stack and have no additional dependencies.

# Installation
1. Copy all files into /var/www/mailadmin and configure a VirtualHost to serve this directory. Allow the .htaccess to verride settings.
2. Edit the config.ini 
3. Create a new SQL table in the database to track logins: ```CREATE TABLE logins (id INT(10) unsigned PRIMARY KEY, nonce VARCHAR(128), session_id VARCHAR(255), timeout INT(15) unsigned);```

# License
The PHP code is GPLv3 licensed. This repo also includes Bootstrap and jQuery files in the folders ```js``` and ```css``` which are MIT licensed.
