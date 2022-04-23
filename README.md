yii2-iro
========

#### Color picker widget for Yii2 ####

[![Latest Stable Version](https://poser.pugx.org/sjaakp/yii2-iro/v/stable)](https://packagist.org/packages/sjaakp/yii2-iro)
[![Total Downloads](https://poser.pugx.org/sjaakp/yii2-iro/downloads)](https://packagist.org/packages/sjaakp/yii2-iro)
[![License](https://poser.pugx.org/sjaakp/yii2-iro/license)](https://packagist.org/packages/sjaakp/yii2-iro)

**yii2-iro** is a widget to choose a color. You can use it in an `ActiveForm` 
like any other `InputWidget` in the [Yii 2.0](https://www.yiiframework.com/ "Yii") PHP Framework.

**yii2-iro** is a wrapper around the excellent [**iro.js** JavaScript color picker](https://iro.js.org/),
 created by James Daniel.

**yii2-iro** can appear in two modes: inline (directly in the page) 
or in a popup-dialog that opens when a colored button is clicked.

A demonstration of **Yii2-iro** is [here](http://www.sjaakpriester.nl/software/iro).

## Installation ##

Install **yii2-iro** in the usual way with [Composer](https://getcomposer.org/). 
Add the following to the require section of your `composer.json` file:

`"sjaakp/yii2-iro": "*"` 

or run:

`composer require sjaakp/yii2-iro` 

You can manually install **yii2-iro** by [downloading the source in ZIP-format](https://github.com/sjaakp/yii2-iro/archive/master.zip).

## Using yii2-iro ##

Use **yii2-iro** just like you would use any other a [`InputWidget`](https://www.yiiframework.com/doc/api/2.0/yii-widgets-inputwidget "Yii Framework").
 For instance, in an [`ActiveForm`](https://www.yiiframework.com/doc/api/2.0/yii-widgets-activeform) 
 you might have something like:

	<?php
	    use sjaakp\iro\IroWidget;
	?>
    ...
    <?php $form = ActiveForm::begin([
        // ...options...
    ]); ?>
    
        <?= $form->field($model, 'name') ?>
        
        <?= $form->field($model, 'favourite_color')->widget(IroWidget::class, [ /* ...options... */ ]) ?>
        ?>
        ...
	
	<?php $form = ActiveForm::end(); ?>
	...
        

To render **yii2-iro** outside of an `ActiveForm` we could use something like:

	<?php
	use sjaakp\iro\IroWidget;
	?>
	...
    <?= IroWidget::widget([
        'name' => 'iro',
        'value' => '#00ff00',
        'popup' => false
        // ...
    ]) ?>;
	...


## Options ##

The **yii2-iro** widget has all the options of a [`InputWidget`](https://www.yiiframework.com/doc/api/2.0/yii-widgets-inputwidget "Yii Framework"),
 plus the following:

#### clientOptions ####

`array` Options for the underlying [**iro.js** color picker](https://iro.js.org/guide.html#color-picker-options).
 Default: `[]`.

#### popup ####

`boolean` Determines the appearance of the **yii2-iro** widget.

- **false** The widget appears inline, directly on the page.
 
- **true** The widget appears as a colored button. Clicking it shows the color button in a modal dialog.

Default: `true`.

#### opacity ####

`boolean` Determines whether or not an opacity (alpha) slider will be provided.

#### colorFormat ####

`string` One of the [color formats](https:https://iro.js.org/color_api.html#supported-color-formats) available to the **iro.js** color picker.
Default: `'hexString'`.

