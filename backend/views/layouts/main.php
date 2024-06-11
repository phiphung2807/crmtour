<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script defer src="https://use.fontawesome.com/releases/v6.5.2/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
        'innerContainerOptions' => [
            'class' => 'container-fluid',
        ],
    ]);

    if (Yii::$app->user->isGuest) {
        $menuItems = [['label' => 'Login', 'url' => ['/site/login']]];
    } else {
        $menuItems = [
            ['label' => 'Người dùng', 'url' => ['/admin'], 'items' => [
                ['label' => 'Danh sách', 'url' => ['/admin/user/index']],
                ['label' => 'Thêm mới', 'url' => ['/admin/user/signup']],
                ['label' => 'Phân quyền', 'url' => ['/admin/assignment/index']],
            ]],

            ['label' => 'Địa điểm', 'url' => ['/place'], 'items' => [
                ['label' => 'Lục địa', 'url' => ['/place/region']],
                ['label' => 'Tiểu vùng', 'url' => ['/place/subregion']],
                ['label' => 'Quốc gia', 'url' => ['/place/country']],
                ['label' => 'Tỉnh/vùng', 'url' => ['/place/state']],
                ['label' => 'Thành phố/Huyện', 'url' => ['/place/city']],
            ]],

            ['label' => 'Khách sạn', 'url' => ['/hotel'], 'items' => [
                ['label' => 'Danh sách', 'url' => ['/hotel/index']],
                ['label' => 'Thêm mới', 'url' => ['/hotel/create']],
                ['label' => 'Tiện nghi', 'url' => ['/facility/index']],
            ]],

            ['label' => 'Acc: '. Yii::$app->user->identity->username, 'url' => '#',
                'dropdownOptions' => ['class' => 'dropdown-menu-end'],
                'items' => [
                    ['label' => 'Đổi mật khẩu', 'url' => ['/admin/user/change-password']],
                    [
                        'label' => 'Đăng xuất',
                        'url' => ['/site/logout'],
                        'linkOptions' => [
                            'data-method' => 'post',
                        ],
                    ],
                ]]
        ];
    }

    $menuItems = \mdm\admin\components\Helper::filter($menuItems);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right ms-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container-fluid">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container-fluid">
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?></p>
        <p class="float-end">"Much effort, much prosperity." - Euripides</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
