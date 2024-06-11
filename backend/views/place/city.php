<?php

use backend\components\TMGridView;
use backend\components\TMAsHelper;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use backend\models\Country;
use backend\models\State;

/** @var yii\web\View $this */
/** @var backend\models\CitySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Danh sách thành phố/huyện';
$this->params['breadcrumbs'][] = $this->title;

$dataDepDrop = [];
if ($searchModel->country_id) {
    $dataDepDrop = ArrayHelper::map(State::findAll(['country_id' => $searchModel->country_id]), 'id', 'name');
} else {
    $dataDepDrop = ArrayHelper::map(State::find()->all(), 'id', 'name');
}
?>
<div class="city-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= TMAsHelper::a('Lục địa', ['region'], ['class' => 'btn btn-success']) ?>
        <?= TMAsHelper::a('Tiểu vùng', ['subregion'], ['class' => 'btn btn-success']) ?>
        <?= TMAsHelper::a('Quốc gia', ['country'], ['class' => 'btn btn-success']) ?>
        <?= TMAsHelper::a('Tỉnh/vùng', ['state'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= TMGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            [
                'attribute' => 'country_id',
                'value' => 'country.name',
                'filter' => Select2::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'country_id',
                        'data' => ArrayHelper::map(Country::find()->all(), 'id', 'name'),
                        'options' => ['id' => 'filter_country_id', 'placeholder' => 'Chọn...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]
                ),
            ],
            'country_code',
            [
                'attribute' => 'state_id',
                'value' => 'state.name',
                'filter' => DepDrop::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'state_id',
                        'data' => $dataDepDrop,
                        'type' => DepDrop::TYPE_SELECT2,
                        'options' => ['id' => 'filter_state_id', 'placeholder' => 'Chọn...'],
                        'select2Options' => [
                            'pluginOptions' => [
                                'allowClear' => true,
                            ],
                        ],
                        'pluginOptions' => [
                            'depends' => ['filter_country_id'],
                            'url' => Url::to(['/place/state-by-country']),
                        ],
                    ]
                ),
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
