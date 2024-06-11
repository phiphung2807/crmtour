<?php

use backend\components\TMGridView;
use backend\components\TMAsHelper;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use backend\models\Region;

/** @var yii\web\View $this */
/** @var backend\models\SubregionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Danh sách tiểu vùng';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subregion-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= TMAsHelper::a('Lục địa', ['region'], ['class' => 'btn btn-success']) ?>
        <?= TMAsHelper::a('Quốc gia', ['country'], ['class' => 'btn btn-success']) ?>
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
            [
                'attribute' => 'region_id',
                'value' => 'region.name',
                'filter' => Select2::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'region_id',
                        'data' => ArrayHelper::map(Region::find()->all(), 'id', 'name'),
                        'options' => ['placeholder' => 'Chọn...'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]
                ),
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
