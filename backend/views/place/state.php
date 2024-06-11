<?php

use backend\components\TMGridView;
use backend\components\TMAsHelper;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use backend\models\Country;

/** @var yii\web\View $this */
/** @var backend\models\StateSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Danh sách tỉnh/vùng';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="state-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= TMAsHelper::a('Lục địa', ['region'], ['class' => 'btn btn-success']) ?>
        <?= TMAsHelper::a('Tiểu vùng', ['subregion'], ['class' => 'btn btn-success']) ?>
        <?= TMAsHelper::a('Quốc gia', ['country'], ['class' => 'btn btn-success']) ?>
        <?= TMAsHelper::a('Thành phố/Huyện', ['city'], ['class' => 'btn btn-success']) ?>
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
                        'options' => ['placeholder' => 'Chọn...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]
                ),
            ],
            'country_code',
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
