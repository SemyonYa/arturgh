<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <nav id="w0" class="navbar-inverse navbar-fixed-top navbar">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w0-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Clients</a>
            </div>
            <div id="w0-collapse" class="collapse navbar-collapse">
                <?php if (!Yii::$app->user->isGuest): ?>
                    <ul id="w1" class="navbar-nav navbar-right nav">
                        <?php if (Yii::$app->user->identity->role === 1): ?>
                            <li><a href="/region">Регионы</a></li>
                            <li><a href="/type">Типы платежей</a></li>
                            <li><a href="/user-list">Пользователи</a></li>
                        <?php endif; ?>
                        <li><a href="/client">Клиенты</a></li>
                        <li>
                            <form action="/site/logout" method="post">
                                <button type="submit" class="btn logout">Выйти (<?= Yii::$app->user->identity->username ?>)</button>
                            </form>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container art">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer>
    CLIENTS
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
