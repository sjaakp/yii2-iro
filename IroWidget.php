<?php
/**
 * MIT licence
 * Version 1.1
 * Sjaak Priester, Amsterdam 11-04-2019 ... 23-04-2021.
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
use yii\web\JsExpression;
use yii\widgets\InputWidget;

class IroWidget extends InputWidget
{
    /**
     * Options for the iro.js color picker
     * @link https://iro.js.org/guide.html#color-picker-options
     * @var array
     */
    public $clientOptions = [];

    /**
     * @var bool
     *  - false the color picker appears inline
     *  - true  the color picker appears in a modal dialog
     */
    public $popup = true;

    /**
     * @var bool
     *  - whether an opacity slider is provided or not
     */
    public $opacity = false;

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

        IroAsset::register($view);
        $id = $this->options['id'];

        if ($this->opacity)   {
            $this->clientOptions['layout'] = [
                [
                    'component' => new JsExpression('iro.ui.Wheel'),
                ],
                [
                    'component' => new JsExpression('iro.ui.Slider'),
                ],
                [
                    'component' => new JsExpression('iro.ui.Slider'),
                    'options' => [
                        'sliderType' => 'alpha'
                    ]
                ],
            ];
        }

        $iroOptions = Json::htmlEncode(array_merge($this->clientOptions, [
            'color' => $this->hasModel() ? $this->model->getAttribute($this->attribute) : $this->value
        ]));

        $varName = str_replace('-', '_', $id) . '_';
        $view->registerJs("var $varName = installIro('$id', $iroOptions, '{$this->colorFormat}')");

        if ($this->popup)   {
            $view->registerCss('
.iro-dialog{margin-top:6em;}
.iro-btn{position:relative;width:4em;height:2em;cursor:pointer;}
.iro-btn::before{content:"";position:absolute;left:0;right:0;top:0;bottom:0;z-index:-1;
  background:url(data:image/gif;base64,R0lGODlhEAAQAKEAAISChPz+/P///wAAACH5BAEAAAIALAAAAAAQABAAAAIfhG+hq4jM3IFLJhoswNly/XkcBpIiVaInlLJr9FZWAQA7);}
.modal-backdrop.in,.modal-backdrop.show{opacity:0;}
');

            $width = ($this->clientOptions['width'] ?? 300) + 32;

            $closeButton = Html::tag('button', '&times;', [
                'class' => 'close',
                'data-dismiss' => 'modal',
                'aria-hidden' => 'true',
                'type' => 'button'
            ]);
            $headerContent = Html::tag('label', $this->hasModel() ?
                $this->model->getAttributeLabel($this->attribute) : $this->name, ['class' => '']) . "\n" . $closeButton;
            $header = Html::tag('div', "\n" . $headerContent . "\n", ['class' => 'modal-header']);
            $bodyContent = Html::tag('div', '', ['id' => $id . '-iro']);
            $body = Html::tag('div', "\n" . $bodyContent . "\n", [
                'class' => 'modal-body',
                'style' => 'display:flex;justify-content:center;'
            ]);
            $modalContent = Html::tag('div', "\n" . $header . "\n" . $body . "\n", ['class' => 'modal-content']);
            $modalDialog = Html::tag('div', "\n" . $modalContent . "\n", [
                'class' => 'modal-dialog iro-dialog',
                'style' => "width:{$width}px;"
            ]);
            $modal = Html::tag('div', "\n" . $modalDialog . "\n", [
                'class' => 'modal fade',
                'id' => $id . '-dlg',
                'role' => 'dialog',
                'tabindex' => -1
            ]);

            $r = $modal . "\n" . Html::tag('div', '', [
                'class' => 'form-control iro-btn',
                'id' => $id . '-btn',
                'data-toggle' => 'modal',
                'data-target' => '#' . $id . '-dlg'
            ]);
        }
        else    {
            $r = Html::tag('div', '', ['id' => $id . '-iro']);
        }

        $r .= "\n" . ($this->hasModel() ? Html::activeHiddenInput($this->model, $this->attribute, $this->options)
            : Html::hiddenInput($this->name, $this->value, $this->options)) . "\n";

        return $r;
    }
}
