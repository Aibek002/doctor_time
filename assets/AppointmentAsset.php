<?php
namespace app\assets;

use yii\web\AssetBundle;
class AppointmentAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/appointments.css',
    ];
    public $js = [
        'js/redirect-to-link.js',
        'js/appointments-ajax.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}