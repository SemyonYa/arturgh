<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $clients \app\models\Client[] */
$this->title = 'Клиенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <table class="crud-table">
        <thead>
        <tr>
            <td>ID</td>
            <td>Ф.И.О.</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($clients as $client): ?>
            <tr onclick="GoTo('/client/view?id=<?= $client->id ?>')">
                <td><?= $client->id ?></td>
                <td><?= $client->name_f ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
