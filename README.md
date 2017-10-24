
Yii2 application example based on united modules
================================================

Installation
------------
- unpack this project to web root
- run in root folder (contains composer.json)
    composer install
- run in root folder init-script
- run migrations in every package of asbsoft vendor

Tunes
-----
This project tuned to work from web root.
If you want to run it from subdir you have to edit htaccess-files
and see in /project/config/config-app.php 'baseUrl' recalculation for 'request' component.
