<?php
/**
 * MIT licence
 * Version 1.1
 * Sjaak Priester, Amsterdam 11-04-2019...23-04-2021.
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
    public $js = [
        '//cdn.jsdelivr.net/npm/@jaames/iro@5'
    ];
    public function init()    {
        parent::init();

        $this->js[] = 'iro-helper.js';
        $this->sourcePath = __DIR__ . DIRECTORY_SEPARATOR . 'assets';
    }
}
