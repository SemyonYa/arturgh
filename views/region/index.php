<?php

use yii\helpers\Html;
use app\models\Region;

/* @var $this yii\web\View */
/* @var $regions Region[] */


$this->title = 'Регионы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <table class="crud-table">
        <thead>
        <tr>
            <td>ID</td>
            <td>Наименование</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($regions as $region): ?>
            <tr onclick="GoTo('/region/update?id=<?= $region->id ?>')">
                <td><?= $region->id ?></td>
                <td><?= $region->name ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>




</div>
