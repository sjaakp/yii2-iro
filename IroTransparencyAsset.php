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

class IroTransparencyAsset extends IroAsset
{
    public function init()    {
        $this->js[] = '//cdn.jsdelivr.net/npm/iro-transparency-plugin/dist/iro-transparency-plugin.min.js';
        parent::init();
    }
}
