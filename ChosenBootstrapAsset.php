<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 13.09.2016
 */
namespace skeeks\widget\chosen;

use yii\web\AssetBundle;

/**
 * Class ChosenAsset
 * @package skeeks\widget\chosen
 */
class ChosenBootstrapAsset extends AssetBundle
{
    public $sourcePath = '@bower/chosen-bootstrap';

    public $css = [
        'chosen.bootstrap.css',
    ];

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'skeeks\widget\chosen\ChosenAsset',
    ];
}
