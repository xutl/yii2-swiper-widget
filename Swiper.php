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
use yii\helpers\Url;
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
    public $options = [];

    /**
     * @var array
     */
    public $clientOptions = [];

    /**
     * @var array
     */
    public $wrapperOptions = [];

    public $paginationOptions = [];

    /**
     * @var array
     */
    public $items = [];

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, 'swiper-container');
        Html::addCssClass($this->wrapperOptions, 'swiper-wrapper');
        Html::addCssClass($this->paginationOptions, 'swiper-pagination');
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $this->initOptions();
        $this->registerAssets();
        return Html::tag('div', $this->renderItems() . $this->renderPagination(), $this->options);
    }

    /**
     * @return string the rendering result.
     */
    protected function renderItems()
    {
        $items = [];
        foreach ($this->items as $item) {
            if (is_array($item)) {
                $items[] = Html::tag('div',
                    Html::a(
                        Html::img($item['img'], ['width' => '100%']),
                        Url::to($item['url'])
                    ),
                    ['class' => 'swiper-slide']
                );
            } else {
                $items[] = $item;
            }
        }
        return Html::tag('div', implode("\n", $items), $this->wrapperOptions);
    }

    protected function renderPagination()
    {
        return Html::tag('div', '', $this->paginationOptions);
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
            'pagination' => '.swiper-pagination',
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
        if (!empty($this->clientOptions)) {
            $clientOptions = Json::encode($this->clientOptions);
            $view->registerJs("var {$this->options['id']} = new Swiper('.swiper-container', {$clientOptions});");
        }
    }
}