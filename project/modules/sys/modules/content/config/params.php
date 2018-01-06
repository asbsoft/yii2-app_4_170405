<?php

// Corrected parameters of content-module,
// will merge with original asbsoft/yii2module-content_2_170309/config/params.php

return [

    // Use external start page from application defaultRoute if true,
    // if FALSE then as start page will use first content page with root = 0
  //'useExternalStartPage' => false, // FALSE - default: will use content start page
    'useExternalStartPage' => true, // will use Yii::$app->defaultRoute for render start page

    // Maximum image size in bytes
    'maxImageSize' => 204800,

    // Minimum required length of data
    'slugMinLength'  => 5, //symbols
    'titleMinLength' => 5, //symbols

];
