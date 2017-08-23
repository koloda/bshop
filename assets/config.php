<?php
/**
 * Configuration file for the "yii asset" console command.
 */

// In the console environment, some path aliases may not exist. Please define these:
Yii::setAlias('@web', __DIR__ . '/../web');
Yii::setAlias('@webroot', realpath(__DIR__ . '/../../../../'));
echo realpath(__DIR__ . '/../../../');
return [
    // Adjust command/callback for JavaScript files compressing:
    // 'jsCompressor' => 'yuicompressor --type js {from} -o {to}',
    // Adjust command/callback for CSS files compressing:
    'cssCompressor' => 'yuicompressor --type css {from} -o {to}',
    // Whether to delete asset source after compression:
    'deleteSource' => false,
    // The list of asset bundles to compress:
    'bundles' => [
        'app\assets\AppAsset',
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
    ],
    // Asset bundle for compression output:
    'targets' => [
        'all' => [
            'class' => 'yii\web\AssetBundle',
            'basePath' => '@webroot/assets',
            'baseUrl' => '@web/assets',
            // 'js' => 'js/all-{hash}.js',
            'css' => 'css/all-{hash}.css',
        ],
    ],
    // Asset manager configuration:
    'assetManager' => [
        'basePath' => '@webroot/assets',
        'baseUrl' => '@web/assets',
    ],
];
