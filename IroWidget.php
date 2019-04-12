<?php
/**
 * MIT licence
 * Version 1.0
 * Sjaak Priester, Amsterdam 11-04-2019.
 *
 * IroWidget Widget for Yii 2.0
 *
 * Color picker widget for the Yii 2.0 PHP Framework.
 *
 * Based on the excellent JavaScript color picker iro.js by James Daniel.
 * @link https://iro.js.org/
 */


namespace sjaakp\iro;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;
use yii\bootstrap\Modal;

class IroWidget extends InputWidget
{
    /**
     * Options for the iro.js color picker
     * If you want to change width, use the widget's $width
     * @link https://iro.js.org/guide.html#color-picker-options
     * @var array
     */
    public $clientOptions = [];

    /**
     * @var int width of the iro color picker in pixels
     */
    public $width = 300;

    /**
     * @var bool
     *  - false the color picker appears inline
     *  - true  the color picker appears in a modal dialog
     */
    public $modal = true;

    /**
     * @var array position of modal relative to the viewport
     */
    public $position = [ 'left' => '4em', 'top' => '6em'];

    /**
     * @var string can be 'hexString', 'rgb', 'rgbString', 'hsl', 'hslString', or 'hsv'
     * @link https://iro.js.org/guide.html#selected-color-api
     */
    public $colorFormat = 'hexString';

    /**
     * @inheritDoc
     */
    public function run()
    {
        $view = $this->getView();

        $asset = new IroAsset();
        $asset->register($view);

        $id = $this->getId();
        $this->options['id'] = $id;

        $w = $this->width + 40;

        $view->registerCss("
        .iro-modal {
            left: {$this->position['left']};
            top: {$this->position['top']};
            right: auto;
            bottom: auto;
        }
        .iro-modal .modal-dialog {
            width: {$w}px;
        }
        .iro-modal .modal-body {
            display: flex;
            justify-content: center;
        }
        .iro-btn {
            width: 4em;
            height: 2em;
            cursor: pointer;
        }
        ");

        $iroOptions = Json::htmlEncode(array_merge($this->clientOptions, [
            'width' => $this->width,
            'color' => $this->value
        ]));

        $view->registerJs('function colBtn(id, c) {
            let btn = document.getElementById(id);
            if (btn) btn.style.backgroundColor = c;
        }');

        $view->registerJs("
        colBtn('{$id}-btn', document.getElementById('{$id}').value);
        var {$id}_ = new iro.ColorPicker('#{$id}-iro', $iroOptions).on('color:change', function(col, changes) {
            console.log(this, col, changes);
         
            document.getElementById('{$id}').value = col.{$this->colorFormat};
            
            colBtn('{$id}-btn', col.hexString);
            });
        ");

        if ($this->modal)   {
            Modal::begin([
                'options' => [
                    'class' => 'iro-modal'
                ],
                'toggleButton' => [
                    'tag' => 'div',
                    'label' => '',
                    'class' => 'form-control iro-btn',
                    'id' => $id . '-btn'
                ],
                'size' => Modal::SIZE_SMALL,
                'header' => $this->hasModel() ? $this->model->attributeLabel($this->attribute) : $this->name
            ]);
        }

        echo Html::tag('div', '', ['id' => $id . '-iro']) . "\n";

        if ($this->modal) Modal::end();

        $r = $this->hasModel() ? Html::activeHiddenInput($this->model, $this->attribute, $this->options)
            : Html::hiddenInput($this->name, $this->value, $this->options);

        return $r;
    }
}
