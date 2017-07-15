<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace xutl\swiper;

use Yii;
use yii\web\AssetBundle;

/**
 * Class SwiperAsset
 * @package xutl\swiper
 */
class SwiperAsset extends AssetBundle
{
    public $sourcePath = '@vendor/xutl/yii2-swiper-widget/assets';

    public $js = [
        'js/swiper.jquery.min.js',
    ];

    public $css = [
        'css/swiper.min.css',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}