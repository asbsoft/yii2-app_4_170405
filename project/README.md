
Application example
===================

Installation
------------
* Use Yii 2 Advanced Project Template with Yii 2 Basic Project Template in /basic folder.
  /basic/vendor/... not need.
* Get this projects with service files and overwrite Yii distributive by these files.
* Get (by composer or manually) vendor dependencies.
* Tune config(s) of project (at /project/config/) and core (at /vendor/asbsoft/yii2-common_2_170212/) if need:
  - for example in /project/config/languages.php select/add/reorder of languages
* You have to prepare your own local configurations (db, etc) in /environments/...
  and run /init to complete system configuration.
  - If you want to work with Yii 2 Basic Project Template create subdomain with web root in /basic/web/
    or tune 'baseUrl' for 'request' component in /basic/config/web-local.php for run basic site from subdir.
* For create core data tables run migrations at
  - /vendor/asbsoft/yii2module/users_0_170112/migrations/
    - tune here id, login, password for admin user(s)
  - /vendor/asbsoft/yii2module/users_0_170112/migrations/rbac/
    - users id here must correspond with previous migrations
  - /vendor/asbsoft/yii2module/content_2_170309/migrations/
  - /vendor/asbsoft/yii2module/modmgr_1_161205/migrations/
* Use root/toor4321 to backend login.
  Add users, change standard passwords and roles for users as you want.
  User(s) with role 'roleRoot' has maximum allows in system.
  New modules can add their own roles like roleContentAuthor/Moderator in content module.
* Before you add first visible content page
  frontend will return you 404 'Not found' error.

Add content pages to site
-------------------------
Only user with 'roleContentAuthor' can create new articles
and edit only own artiles until its unvisible at frontend.
Only user with 'roleContentModerator' can change visibility and delete every article.
Content moderator also can edit all articles.
