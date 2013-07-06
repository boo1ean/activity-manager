<?php

namespace app\libs\widgets;

use yii\helpers\Html;
use yii\base\InvalidParamException;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\base\Model;

/**
 * Datetimepicker displays custom datetimepicker control.
 *
 * This widget uses javascript plugin placed here
 * http://tarruda.github.io/bootstrap-datetimepicker/
 *
 * For correct usage of this usage ensure that you loaded:
 * - bootstrap.min.js
 * - bootstrap-datetimepicker.min.js
 * - bootstrap-datetimepicker.min.css
 *
 * Widget generates "dtp" (short for "datetimepicker") prefix for div container.
 * So basic usage with js plugin is:
 *
 * $("#dtp-your_form_field_name").datetimepicker({
 *       format: 'dd/MM/yyyy hh:mm:ss'
 * });
 *
 * Thanks for reading this! Enjoy!
 *
 * m1x0n
 */
class Datetimepicker extends Widget {
    /**
     * @var Model $model
     */
    public $model;

    /**
     * @var string
     */
    public $attribute;

    /**
     * Available options:
     *  value - input value
     *  inputClass - input class
     *
     * @var array $options
     */
    public $options = array();

    public $containerId = "dtp-";

    public $containerClass = "input-append date";

    public function init() {
        if ($this->model === null) {
            throw new InvalidConfigException('Please specify model');
        }

        if (!$this->model instanceof Model) {
            throw new InvalidParamException('Model param must be an instance of yii\\base\\Model');
        }
    }

    public function run()
    {
        $modelName = $this->_retrieveModelName();

        $control = Html::beginTag('div',
            array(
                'id'    => $this->containerId . $this->attribute,
                'class' => $this->containerClass
            )
        );

        $options = $this->options;

        $value = (empty($options['value'])) ? $this->model->{$this->attribute} : $options['value'];

        $control .= Html::input(
            'text',
            $modelName . "[{$this->attribute}]",
            $value,
            array(
                'id'    => strtolower($modelName) . '-' . $this->attribute,
                'class' => empty($options['inputClass']) ? 'input-xlarge' : $options['inputClass']
            )
        );

        $control .= $this->_appendAddon();
        $control .= Html::endTag('div');

        echo $control;
    }

    /**
     * Append time and calendar icons to input field
     * @return string
     */
    private function _appendAddon() {
        return '
            <span class="add-on">
                <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
            </span>
        ';
    }

    /**
     * Retrieve model name for attributes
     *
     * @return string
     */
    private function _retrieveModelName() {
        return join('', array_slice(explode('\\', get_class($this->model)), -1));
    }


}