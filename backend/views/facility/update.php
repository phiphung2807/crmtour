<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Facility $model */

$this->title = 'Sửa mục: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Danh sách tiện nghi khách sạn', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
?>
<div class="facility-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
