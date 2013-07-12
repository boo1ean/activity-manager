<?php

namespace app\libs\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use app\libs\wrappers\bitly\Bitly;
use Yii;

/**
 * BitlyUrl provides links shorten/expand using Bitly service wrapper
 *
 * Basic usage:
 *
 * BitlyUrl::widget(array('url' => 'http://google.com', 'expand' => false))
 *
 */
class BitlyUrl extends Widget {

    /**
     * Bitly wrapper
     * @var Bitly|null
     */
    private $bitly = null;

    /**
     * Link to process
     * @var string
     */
    public $url = '';

    /**
     * API method switcher
     * @var bool
     */
    public $expand = false;

    public function init()
    {
        $this->bitly = new Bitly(
            Yii::$app->params['bitly_login'],
            Yii::$app->params['bitly_api_key']
        );
    }

    public function run()
    {
       $response =  (!$this->expand)
           ? $this->bitly->shorten(array('longUrl' => $this->url))
           : $this->bitly->expand(array('shortUrl' => $this->url));


       $url = (!$this->expand) ? $response->url : $response->long_url;

       echo Html::a($url, $url);
    }
}