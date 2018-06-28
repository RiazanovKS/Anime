<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use backend\widgets\AndNav;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use backend\models\Page;
use backend\models\StaticTextItem;
use backend\models\UserRole;
use backend\models\Base;
use backend\models\PageItem;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <!--<script>//var INLINE_SVG_REVISION = <? //=filemtime(\Yii::getAlias('@frontend/web/svg.html'))?>;</script>-->

        <meta charset="<?= Yii::$app->charset ?>">
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <?= Html::csrfMetaTags() ?>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/main.css">


    </head>
    <body class="body">
    <?php $this->beginBody() ?>

    <?

    $isAbout = \Yii::$app->request->url == $this->params[Page::PAGE_PREFIX . Page::ABOUT_COMPANY]['linkOut'];
    $isContacts = \Yii::$app->request->url == $this->params[Page::PAGE_PREFIX . Page::CONTACTS_PAGE]['linkOut'];
    $isDelivery = \Yii::$app->request->url == $this->params[Page::PAGE_PREFIX . Page::DELIVERY]['linkOut'];
    $isMain = \Yii::$app->controller->id == 'site';
    $isCategory = \Yii::$app->controller->id == 'category';
    $isDesign = \Yii::$app->controller->id == 'design-collection';
    $isReview = \Yii::$app->controller->id == 'review';
    $isError = \Yii::$app->controller->action->id  == 'error';
    //$isProduct = \Yii::$app->controller->id == 'product';
    //$isView = \Yii::$app->controller->action->id == 'view';
    ?>

    <header>
        <div class="container d-flex fx-space-between">
            <a class="container__logo" href="/">AniFOX</a>
            <ul class="container__menu">
                <li><a class="active" href="#">Главная</a></li>
                <li><a href="#">Манга</a></li>
                <li><a href="">Онгоинги</a></li>
                <li><a href="">Анонсы</a></li>
            </ul>
        </div>
    </header>
    <main>
    <?= $content ?>
    </main>
    </body>
    </html>
<?php $this->endBody() ?>
<?php $this->endPage() ?>