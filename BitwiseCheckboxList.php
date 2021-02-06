<?php
namespace smukm\bcl\BitwiseCheckboxList;

use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\InputWidget;

class BitwiseCheckboxList extends InputWidget
{
    const BITS = [1, 2, 4, 8, 16, 32, 64, 128, 256, 512, 1024, 2048, 4096, 8192, 16384, 32768];

    /**
     * @var array
     */
    public $data = [];

    /**
     * @var array options for wrapper html element
     */
    public $wrapper_options = [];

    /**
     * @var string html element for checkbox wrapper
     */
    public $checkbox_wrapper_tag = 'div';

    /**
     * @var array options for checkbox wrapper html element
     */
    public $checkbox_wrapper_options = [];

    /**
     * @var string row html template
     */
    public $template_row = '<div class="row">{cols}</div>';

    /**
     * @var string column html template
     */
    public $template_col = '<div class="col">%s</div>';

    /**
     * @var int number of columns
     */
    public $columns = 2;

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();

        $this->initialize();


    }

    public function run(): string
    {
        $this->registerJs();

        return $this->renderWidget();
    }


    public function renderWidget(): string
    {
        if($this->hasModel()) {
            $this->value = $this->model->{$this->attribute};
            $this->name = Html::getInputName($this->model, $this->attribute);
            $cb_name =  str_replace(['[', ']'], '',  $this->name);
        } else {
            $cb_name =  $this->name . '_option';
        }

        $hidden = Html::hiddenInput($this->name, $this->value, ['id' => $this->options['id']]);

        $options = $this->prepareOptions($cb_name);

        $cols = str_repeat($this->template_col, $this->columns);
        $template = str_replace('{cols}', $cols, $this->template_row);
        $options_chunks = array_chunk($options, round(sizeof($options)/$this->columns));

        array_walk($options_chunks, function (&$item) {
            $item = implode('', $item);
        });

        $grid = vsprintf($template, $options_chunks);

        return Html::tag(
            'div',
            $hidden . $grid,
            array_merge(['id' => 'field-' . $this->options['id']], $this->wrapper_options)
        );;
    }

    protected function prepareOptions($cb_name): array
    {
        $options = [];
        foreach (self::BITS as $bit) {
            if(!isset($this->data[$bit])) {
                continue;
            }
            $label = $this->data[$bit];

            $options[] = Html::tag($this->checkbox_wrapper_tag,
                Html::checkbox($cb_name . '[]', ($this->value & $bit), ['value' => $bit]) . ' ' . $label,
                $this->checkbox_wrapper_options
            );
        }

        return $options;
    }
    protected function initialize(): void
    {
        if(empty($this->data)) {
            $this->data = array_combine(self::BITS, self::BITS);
        }

        if($this->columns > sizeof($this->data)) {
            throw new InvalidConfigException(__CLASS__ . '.columns must be less then size of the bits array');
        }
    }

    protected function registerJs()
    {
        $view = $this->getView();
        BitwiseCheckboxAsset::register($view);
        $element_id = $this->options['id'];
        $view->registerJs("vv68.bwWidget.register('$element_id');", View::POS_END);
    }
}