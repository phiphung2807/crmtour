<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Hotel $model */

$this->title = 'Cập nhật khách sạn: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Danh sách khách sạn', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="hotel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
