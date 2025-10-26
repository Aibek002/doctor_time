<?php
namespace app\assets;

use yii\web\AssetBundle;
class HomeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/home.css',
    ];
    public $js = [
        'js/home.js',
        'js/redirect.-to-link.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}