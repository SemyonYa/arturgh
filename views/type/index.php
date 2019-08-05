<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Типы платежей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить тип платежа', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <table class="crud-table">
        <thead>
        <tr>
            <td>ID</td>
            <td>Наименование</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($types as $type): ?>
            <tr onclick="GoTo('/type/update?id=<?= $type->id ?>')">
                <td><?= $type->id ?></td>
                <td><?= $type->name ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
