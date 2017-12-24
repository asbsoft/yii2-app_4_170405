
Yii2 application example based on united modules
================================================

Installation
------------
- Download from https://github.com/asbsoft/yii2-app_4_170405
  and unpack this project to hosting's web root.
  (or git clone https://github.com/asbsoft/yii2-app_4_170405.git)
- Run in root folder contains composer.json file:
    composer install
- Prepare and save if need your own configurations
  (for database, backend URL prefix, etc) in /environments/ folder.
  Note that these configs are various for different debug modes
  and standard Yii2-application templates (basic, advanced) according to their structure.
  Then run init-script in root folder.
- Apply all migrations (yii migrate/up ...) in every package of asbsoft vendor.
  In users-package migrations you cat tune default users logins and passwords.
- Note that "composer install" is slowest and not optimal part of installation
  (will download more than 300MB dependencies instead of less than 100MB really required).
  To optimize this process after download asbsoft/yii2-app_4_170405
  you can download standard yii2-application (for example
  https://github.com/yiisoft/yii2/releases/download/2.0.12/yii-basic-app-2.0.12.tgz)
  and get from it only whole /vendor/-folder and necessarily /composer.lock (not /composer.json) file.
  Next download by composer only required for yii2-app_4_170405 packages from asbsoft-vendor
  (see /composer.json), for example
    composer require asbsoft/yii2module-content_2_170309
  and other if need (usually installation one of them install all another).

Notes
-----
- This project tuned to work from web root using Apache's mod_rewrite.
  If you want to run it from subdir you have to edit htaccess-files
  and change in /project/config/config-app.php 'baseUrl' recalculation for 'request' component.
- This project support both basic and advanced Yii2-application templates.
  (Advanced application template has different web roots for backend and frontend)
- If you can't use Composer for installation, you can install it manually in such way:
  * Get from http://www.yiiframework.com/download advanced or/and basic application template(s).
  * Unpack Yii2-advanced archieve to hosting's web root, basic - to /basic/ subdirectory.
    Directory /basic/vendor/ not use - move it to /vendor/ or delete - it sharing with advanced application.
  * Then get this project and put it to hosting's web root, owerwrite existing Yii2-application(s) files.
  * If 'composer install' at this step impossible, you can install required asbsoft-packages
    manually in /vendor/asbsoft/. Note that these packages can have another dependencies
    especially 'asbsoft/yii2-common...' (kernel) package.
    Packages installed in such way can not find by system class autoloader,
    because Composer's did not write their namespace places in /vendor/composer/autoload_psr4.php.
    Edit this file manually or use another way supported in Yii2 - define Yii2-aliases of namespace prefixes:
    look up and edit them in /project/config/extensions-aliases.php 
  * At last prepare environments-configs, run init script in root and apply migrations.
- For basic backend URL prefix can be tune before init script
  in /environments/*/basic/config/params-local.php:
    'adminPath'  => 'adm',
- For advanced backend you can use subdomain
  or URL prefix as in basic - tune /.htaccess and accordingly /backend/config/main.php:
    $adminUrlPrefixHtaccess = 'back';

