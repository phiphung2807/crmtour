<?php

use backend\models\Hotel;
use backend\components\TMGridView;
use backend\components\TMActionColumn;
use backend\components\TMAsHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var backend\models\HotelSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Danh sách khách sạn';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotel-index">

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

            'id',
            'name',
            'long_desc:ntext',
            'state_id',
            'city_id',
            //'short_desc',
            //'note:ntext',
            //'price',
            //'price_discount',
            //'created_at',
            //'created_user',
            //'updated_at',
            //'updated_user',
            //'status',
            [
                'class' => TMActionColumn::className(),
                'urlCreator' => function ($action, Hotel $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
