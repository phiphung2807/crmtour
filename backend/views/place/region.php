<?php

use backend\components\TMGridView;
use backend\components\TMAsHelper;
use yii\helpers\Html;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var backend\models\RegionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Danh sách lục địa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= TMAsHelper::a('Tiểu vùng', ['subregion'], ['class' => 'btn btn-success']) ?>
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
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
