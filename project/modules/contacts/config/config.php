<?php
    // Example of redefine parameters of inheritance module

    use asb\yii2\common_2_170212\base\UniApplication;
    use asb\yii2\modules\contactform_3_170124\controllers\AdminController;

    use asb\yii2\modules\contactform_3_170124\helpers\RestUrlRule;


    //$sublink_front = 'contactform'; // default
    $sublink_front = 'contacts'; // change
    $sublink_back = 'contactform-back'; // default
    
    /** Default module config */
    return [
        //'params' => include(__DIR__ . '/params.php'),

        'routesConfig' => [ // type => prefix | array(config)
            'main'  => [
                'urlPrefix'      => $sublink_front,
                'startLinkLabel' => 'Contact us',
            ],
            'admin' =>  [
                'urlPrefix' => AdminController::$adminPath === false
                                 ? false
                                 : (AdminController::$adminPath === '' ? '' : (AdminController::$adminPath . '/'))
                                   . $sublink_back,
                'startLink' => [
                    'label' => 'Contactform messages v3',
                  //'link'  => '', // default
                    'action' => 'admin/index',
                ],
            ],
            'rest'  => [
                'class' => RestUrlRule::className(),
                'urlPrefix' => 'contactform-api',
                'sublink'   => 'contact-msg',
                'startLink' => [
                    'label'  => 'Contacts API',
                    'action' => 'rest/index',
                ],
            ],
        ],
    ];
