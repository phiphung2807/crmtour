<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Facility $model */

$this->title = 'Thêm mới tiện nghi khách sạn';
$this->params['breadcrumbs'][] = ['label' => 'Danh sách tiện nghi khách sạn', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="facility-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
