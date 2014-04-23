<?php
namespace lagman\bootstrap;

use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\VarDumper;

/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */
class Panel extends \yii\base\Widget
{
    const
        TYPE_DEFAULT = 'default',
        TYPE_PRIMARY = 'primary',
        TYPE_SUCCESS = 'success',
        TYPE_INFO = 'info',
        TYPE_WARNING = 'warning',
        TYPE_DANGER = 'danger';

    public $header, $content, $footer;

    public $type = 'default';

    public $hasBody = true;

    public $options = ['class' => 'panel'];
    public $bodyOptions = ['class' => 'panel-body'];
    public $headerOptions = ['class' => 'panel-heading'];
    public $footerOptions = ['class' => 'panel-footer'];

    public function init()
    {
        if (!in_array($this->type, [
            self::TYPE_DEFAULT,
            self::TYPE_PRIMARY,
            self::TYPE_SUCCESS,
            self::TYPE_INFO,
            self::TYPE_WARNING,
            self::TYPE_DANGER
        ])
        )
            throw new InvalidConfigException('Invalid panel type: ' . VarDumper::dumpAsString($this->type));

        if (!isset($this->options['id']))
            $this->options['id'] = $this->getId();

        Html::addCssClass($this->options, "panel-{$this->type}");
        echo Html::beginTag('div', $this->options);
        if (isset($this->header))
            echo Html::tag('div', $this->header, $this->headerOptions);
        if ($this->hasBody)
            echo Html::beginTag('div', $this->bodyOptions);
    }

    public function run()
    {
        echo $this->content;
        if ($this->hasBody) {
            echo Html::endTag('div');
        }
        if (isset($this->footer))
            echo Html::tag('div', $this->footer, $this->footerOptions);
        echo Html::endTag('div');
    }
}