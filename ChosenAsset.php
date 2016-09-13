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
    public $sourcePath = '@bower/chosen';

    public $js = [
        'chosen.jquery.min.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
