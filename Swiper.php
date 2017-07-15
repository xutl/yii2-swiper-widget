<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

namespace xutl\swiper;

use yii\base\Widget;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\base\InvalidConfigException;
use yii\web\View;

/**
 * Class Swiper
 * @package xutl\swiper
 */
class Swiper extends Widget
{
    /**
     * @var array the HTML attributes for the input tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [
        'class' => 'swiper-container',
    ];

    /**
     * @var array
     */
    public $clientOptions = [];

    /**
     * @var array
     */
    public $items = [];

    /**
     * @var array the HTML attributes for the input tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $itemOptions = [];

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        $this->initOptions();
        $this->registerAssets();
    }

    /**
     * Initializes the widget options
     */
    protected function initOptions()
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = 'swiper_' . $this->getId();
        }
        $this->clientOptions = array_merge([
            'pagination' => 'swiper-pagination',
            'autoplay' => 3000,
            'speed' => 400,
            'autoplayDisableOnInteraction' => false,
        ], $this->clientOptions);
    }

    /**
     * Registers the needed assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        SwiperAsset::register($view);


        echo Html::tag('div', '', $this->options);


        if (!empty($this->clientOptions)) {
            $clientOptions = Json::encode($this->clientOptions);
            $view->registerJs("var {$this->options['id']} = new Swiper('.{$this->options['id']}', {$clientOptions});");
        }
    }
}