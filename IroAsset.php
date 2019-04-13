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
    public $js = [
        '//cdn.jsdelivr.net/npm/@jaames/iro/dist/iro.min.js',
        '//cdn.jsdelivr.net/npm/iro-transparency-plugin/dist/iro-transparency-plugin.min.js',
        'iro-helper.js'
    ];
    public $depends = ['yii\bootstrap\BootstrapPluginAsset'];
    public function init()    {
        parent::init();

        $this->sourcePath = __DIR__ . DIRECTORY_SEPARATOR . 'assets';
    }
}
