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

use yii\web\AssetBundle;

class IroAsset extends AssetBundle
{
    public $js = ['https://cdn.jsdelivr.net/npm/@jaames/iro/dist/iro.min.js'];
    public $depends = ['yii\web\JqueryAsset'];
}
