<?php
/**
 * The manifest of files that are local to specific environment.
 * This file returns a list of environments that the application
 * may be installed under. The returned data must be in the following
 * format:
 *
 * ```php
 * return [
 *     'environment name' => [
 *         'path' => 'directory storing the local files',
 *         'skipFiles'  => [
 *             // list of files that should only copied once and skipped if they already exist
 *         ],
 *         'setWritable' => [
 *             // list of directories that should be set writable
 *         ],
 *         'setExecutable' => [
 *             // list of files that should be set executable
 *         ],
 *         'setCookieValidationKey' => [
 *             // list of config files that need to be inserted with automatically generated cookie validation keys
 *         ],
 *         'createSymlink' => [
 *             // list of symlinks to be created. Keys are symlinks, and values are the targets.
 *         ],
 *     ],
 * ];
 * ```
 */
return [
    'Development' => [
        'path' => basename(__FILE__, '.php'), // 'path' => 'dev',
        'setWritable' => [
            'runtime',
          //'backend/runtime',
            'backend/web/assets',
            'backend/web/files',
          //'frontend/runtime',
            'frontend/web/assets',
            'frontend/web/files',
          //'basic/runtime',
            'basic/web/assets',
            'basic/web/files',
        ],
        'setExecutable' => [
            'yii',
            'yii_test',
        ],
        'setCookieValidationKey' => [
            'backend/config/cookie-key.php',
            'frontend/config/cookie-key.php',
            'basic/config/cookie-key.php',
        ],
    ],
];
