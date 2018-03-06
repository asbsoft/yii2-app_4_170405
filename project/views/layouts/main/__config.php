<?php

    use asb\yii2\common_2_170212\i18n\LangHelper;


    $tc = 'layout/main';  // original for layout

    if (empty($siteName)) $siteName = Yii::t($tc, 'ASBsoft CMS');

    if (empty($brandLabel)) $brandLabel = Yii::t($tc, 'ASBsoft');

    // modules unique IDs
    $moduleUsersUid    = 'sys/users';
  //$moduleContactsUid = 'contacts-ext';
    $moduleContactsUid = 'contacts-in-project';
  //$moduleNewsUid     = 'news-ext';
    $moduleNewsUid     = 'news-in-project';

    // select here type of languages switcher
  //$langSwitchType = 'list';     // or empty means default type - list of items, JS not need
  //$langSwitchType = 'dropdown'; // JS need
  //$langSwitchType = 'select';   // JS need

    $languages = LangHelper::activeLanguages();

  //$showLinkToBackend = true; // uncomment if need to show link to backend in menu (basic application only)
