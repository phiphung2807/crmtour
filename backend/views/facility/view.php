<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\components\TMAsHelper;

/** @var yii\web\View $this */
/** @var backend\models\Facility $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Danh sách tiện nghi khách sạn', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="facility-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= TMAsHelper::a('Sửa', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= TMAsHelper::a('Xóa', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Bạn chắc chắn xóa mục này?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'icon',
        ],
    ]) ?>

</div>
