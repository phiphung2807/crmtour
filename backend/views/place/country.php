<?php

use backend\components\TMGridView;
use backend\components\TMAsHelper;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use backend\models\Region;
use backend\models\Subregion;

/** @var yii\web\View $this */
/** @var backend\models\CountrySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Danh sách quốc gia';
$this->params['breadcrumbs'][] = $this->title;

$dataDepDrop = [];
if ($searchModel->region_id) {
    $dataDepDrop = ArrayHelper::map(Subregion::findAll(['region_id' => $searchModel->region_id]), 'id', 'name');
} else {
    $dataDepDrop = ArrayHelper::map(Subregion::find()->all(), 'id', 'name');
}
?>
<div class="country-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= TMAsHelper::a('Lục địa', ['region'], ['class' => 'btn btn-success']) ?>
        <?= TMAsHelper::a('Tiểu vùng', ['subregion'], ['class' => 'btn btn-success']) ?>
        <?= TMAsHelper::a('Tỉnh/vùng', ['state'], ['class' => 'btn btn-success']) ?>
        <?= TMAsHelper::a('Thành phố/Huyện', ['city'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= TMGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'iso2',
            'phonecode',
            'capital',
            'currency',
            [
                'attribute' => 'region',
                'filter' => Select2::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'region_id',
                        'data' => ArrayHelper::map(Region::find()->all(), 'id', 'name'),
                        'options' => ['id' => 'filter_region_id', 'placeholder' => 'Chọn...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]
                ),
            ],
            [
                'attribute' => 'subregion',
                'filter' => DepDrop::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'subregion_id',
                        'data' => $dataDepDrop,
                        'type' => DepDrop::TYPE_SELECT2,
                        'options' => ['id' => 'filter_subregion_id', 'placeholder' => 'Chọn...'],
                        'select2Options' => [
                            'pluginOptions' => [
                                'allowClear' => true,
                            ],
                        ],
                        'pluginOptions' => [
                            'depends' => ['filter_region_id'],
                            'url' => Url::to(['/place/subregion-by-region']),
                        ],
                    ]
                ),
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
