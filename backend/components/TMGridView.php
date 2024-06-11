<?php

namespace backend\components;

use kartik\grid\GridView;

class TMGridView extends GridView
{
    /**
     * Creates a widget instance and runs it.
     * The widget rendering result is returned by this method.
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @return string the rendering result of the widget.
     * @throws \Exception
     */
    public static function widget($config = [])
    {
        $config = array_merge($config, [
            'pager' => [
                'class' => \yii\bootstrap5\LinkPager::className(),
                'firstPageLabel' => 'Đầu',
                'lastPageLabel'  => 'Cuối'
            ],
        ]);

        return parent::widget($config);
    }
}