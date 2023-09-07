<?php

/** @var yii\web\View $this */
/** @var string $content */
// ['label' => 'Home', 'url' => ['/site/index']],
//  ['label' => 'SingIn', 'url' => ['/usuario/index']],
// ['label' => 'Product', 'url' => ['/product/index']],
// ['label' => 'Category', 'url' => ['/category/index']],
// ['label' => 'ProductCategory', 'url' => ['/product-category/index']],
use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header id="header">
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Url::toRoute(['site/index']),
            'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
        ]);


        if (!Yii::$app->user->isGuest) {
            $opcArray[] = [
                "label" =>  "Home",
                "url" => Url::toRoute(['site/index']),
            ];
            $opcArray[] = [
                "label" =>  "Product",
                "url" => Url::toRoute(['product-category/index']),
            ];
            $opcArray[] = [
                "label" =>  "Category",
                "url" => Url::toRoute(['category/index']),
            ];

            $logout =  '<li class="nav-item">'
                . Html::beginForm(['/site/logout'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'nav-link btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
            $opcArray[] = $logout;
        }else{
            $opcArray[]=[
                "label" =>  "Login",
                "url" => Url::toRoute(['site/login']),
            ];
        }


        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right', 'style'=>'width: 100%;'],
            'items' => $opcArray
        ]);
        NavBar::end();
        ?>
    </header>

    <main id="main" class="flex-shrink-0" role="main">
        <div class="container">
            <?php if (!empty($this->params['breadcrumbs'])) : ?>
                <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
            <?php endif ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <footer id="footer" class="mt-auto py-3 bg-light">
        <div class="container">
            <div class="row text-muted">
                <div class="col-md-6 text-center text-md-start">&copy; My Company <?= date('Y') ?></div>
                <div class="col-md-6 text-center text-md-end">EBorne</div>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>