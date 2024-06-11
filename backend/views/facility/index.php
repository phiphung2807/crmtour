<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use backend\components\TMGridView;
use backend\components\TMActionColumn;
use backend\components\TMAsHelper;

/** @var yii\web\View $this */
/** @var backend\models\FacilitySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Danh sách tiện nghi khách sạn';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="facility-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= TMAsHelper::a('Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= TMGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'icon',
            ['class' => TMActionColumn::className()],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
