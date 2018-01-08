<?php
// Example of inherited module
// To install parent module run in project root
// $ composer require asbsoft/yii2module-news_1b_160430
// $ composer require asbsoft/yii2module-news_2b_161124
// $ composer require asbsoft/yii2module-news_3b_171202
// - last command enough for all

namespace project\modules\news;

// Select functionality by uncomment only one version of ancestor-module:
//use asb\yii2\modules\news_1b_160430\Module as ParentModule; // inherit base functionality
//use asb\yii2\modules\news_2b_161124\Module as ParentModule; // +slugs, +backup
use asb\yii2\modules\news_3b_171202\Module as ParentModule;   // +tags

class Module extends ParentModule
{
}
