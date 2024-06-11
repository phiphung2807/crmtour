<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Hotel $model */

$this->title = 'Thêm mới khách sạn';
$this->params['breadcrumbs'][] = ['label' => 'Danh sách khách sạn', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
