<?php
namespace app\assets;

use yii\web\AssetBundle;
class PatientsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/patients.css',
    ];
    public $js = [
        'js/redirect-to-link.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}