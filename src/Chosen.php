<?php
/**
 * Chosen
 *
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010-2014 SkeekS (Sx)
 * @date 31.10.2014
 * @since 1.0.0
 */
namespace skeeks\widget\chosen;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\widgets\InputWidget;

/**
 * Class Chosen
 * @package skeeks\widget\chosen
 */
class Chosen extends InputWidget
{

    public static $autoIdPrefix = 'Chosen';

    /**
     * @var boolean whether to render input as multiple select
     */
    public $multiple = false;

    /**
     * @var boolean whether to show deselect button on single select
     */
    public $allowDeselect = true;

    /**
     * @var integer|boolean hide the search input on single selects if there are fewer than (n) options or disable at all if set to true
     */
    public $disableSearch = 10;

    /**
     * @var bool
     */
    public $disabled        = false;
    
    /**
     * @var string placeholder text
     */
    public $placeholder = null;

    /**
     * @var string category for placeholder translation
     */
    public $translateCategory = 'app';

    /**
     * @var array items array to render select options
     */
    public $items = [];

    /**
     * @var array options for Chosen plugin
     * @see http://harvesthq.github.io/chosen/options.html
     */
    public $clientOptions = [];

    /**
     * @var array event handlers for Chosen plugin
     * @see http://harvesthq.github.io/chosen/options.html#triggered-events
     */
    public $clientEvents = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->multiple) {
            $this->options['multiple'] = 'multiple';
        } elseif ($this->allowDeselect) {
            $this->items = ArrayHelper::merge([null => ''], $this->items);
            $this->clientOptions['allow_single_deselect'] = true;
        }
        if ($this->disableSearch === true) {
            $this->clientOptions['disable_search'] = true;
        } else {
            $this->clientOptions['disable_search_threshold'] = $this->disableSearch;
        }
        
        $this->clientOptions['placeholder_text_single'] = \Yii::t($this->translateCategory, $this->placeholder ? $this->placeholder : 'Выберите опцию');
        $this->clientOptions['placeholder_text_multiple'] = \Yii::t($this->translateCategory, $this->placeholder ? $this->placeholder : 'Выберите несколько опций');
        $this->clientOptions['no_results_text'] = \Yii::t('app', 'Результатов не найдено');
        
        $this->options['unselect'] = null;
        if ($this->disabled)
        {
            $this->options['disabled'] = 'disabled';
        }
        $this->registerScript();
        $this->registerEvents();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->hasModel()) {
            echo Html::hiddenInput(Html::getInputName($this->model, $this->attribute)); //TODO:bad hardcode
            echo Html::activeListBox($this->model, $this->attribute, $this->items, $this->options);
        } else {
            echo Html::hiddenInput($this->name); //TODO:bad hardcode
            echo Html::listBox($this->name, $this->value, $this->items, $this->options);
        }
    }

    /**
     * Registers chosen.js
     */
    public function registerScript()
    {
        ChosenBootstrapAsset::register($this->getView());
        $clientOptions = Json::encode($this->clientOptions);
        $id = $this->options['id'];
        $this->getView()->registerJs("jQuery('#$id').chosen({$clientOptions});");
    }

    /**
     * Registers Chosen event handlers
     */
    public function registerEvents()
    {
        if (!empty($this->clientEvents)) {
            $js = [];
            foreach ($this->clientEvents as $event => $handle) {
                $handle = new JsExpression($handle);
                $js[] = "jQuery('#{$this->options['id']}').on('{$event}', {$handle});";
            }
            $this->getView()->registerJs(implode(PHP_EOL, $js));
        }
    }
}