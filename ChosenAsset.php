<?php
/**
 * ChosenAsset
 *
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010-2014 SkeekS (Sx)
 * @date 31.10.2014
 * @since 1.0.0
 */
namespace skeeks\widget\chosen;

use yii\web\AssetBundle;

/**
 * Class ChosenAsset
 * @package skeeks\widget\chosen
 */
class ChosenAsset extends AssetBundle
{
    public $sourcePath = '@vendor/skeeks/yii2-widget-chosen/assets';

    public $css = [
        'css/chosen.bootstrap.css'
    ];

    public $js = [
        'js/chosen.jquery.js'
    ];

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
    ];
}
