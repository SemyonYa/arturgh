<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Client */

$this->title = $model->fio;
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="client-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Действительно удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div>

        <!-- Навигационные вкладки -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Данные
                    о клиенте</a></li>
            <li role="presentation"><a href="#payments" aria-controls="payments" role="tab" data-toggle="tab">Взносы и
                    выплаты</a></li>
            <li role="presentation"><a href="#net" aria-controls="net" role="tab"
                                       data-toggle="tab">Сеть</a></li>
            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab"
                                       data-toggle="tab">Settings</a></li>
        </ul>

        <!-- Вкладки панелей -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <div class="client-data">
                    <label>Ф.И.О.</label>
                    <span><?= $model->name_f . ' ' . $model->name_i . ' ' . $model->name_o ?></span>
                    <label><?= $model->attributeLabels()['birth'] ?></label>
                    <span><?= date('d.m.Y', strtotime($model->birth)) ?></span>
                    <label><?= $model->attributeLabels()['inn'] ?></label>
                    <span><?= $model->inn ?></span>
                    <label><?= $model->attributeLabels()['snils'] ?></label>
                    <span><?= $model->snils ?></span>
                    <label><?= $model->attributeLabels()['place_reg'] ?></label>
                    <span><?= $model->place_reg ?></span>
                    <label><?= $model->attributeLabels()['place_live'] ?></label>
                    <span><?= $model->place_live ?></span>
                    <label><?= $model->attributeLabels()['parent_id'] ?></label>
                    <span><?= $model->parent_id ? $model->parent->fio : '-' ?></span>
                    <label><?= $model->attributeLabels()['region_id'] ?></label>
                    <span><?= $model->region->name ?></span>
                    <label><?= $model->attributeLabels()['level'] ?></label>
                    <span><?= $model->level ?></span>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="payments">
                <div class="client-payments">
                    <div class="client-payments-in">
                        <button class="btn btn-in">Добавить взнос</button>
                        <div class="client-payments-in-items">
                            <?php for ($payment = 1; $payment < 10; $payment++): ?>
                                <div class="client-payments-in-item">
                                    <span class="client-payments-in-item-date"><?= date('d.m.Y', strtotime($model->birth)) ?></span>
                                    <span class="client-payments-in-item-sum"><?= $payment * $payment * 1200 ?> &#8381;</span>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="client-payments-out">
                        <button class="btn btn-out">Добавить выплату</button>
                        <div class="client-payments-out-items">
                            <?php for ($payment = 1; $payment < 8; $payment++): ?>
                                <div class="client-payments-out-item">
                                    <span class="client-payments-in-item-date"><?= date('d.m.Y', strtotime($model->birth)) ?></span>
                                    <span class="client-payments-in-item-sum"><?= $payment * $payment * 1050 ?> &#8381;</span>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane tab-net" id="net">
                <?php if ($model->hasChildren()): ?>
                    <?php $model->printChildren(); ?>
                <?php else: ?>
                    <div class="alert alert-info">Отсутствуют приведенные клиенты</div>
                <?php endif; ?>
            </div>
<!--            <div role="tabpanel" class="tab-pane" id="settings">-->
<!--                <pre>-->
<!--                --><?php
//                print_r($model->parents)
//                ?>
<!--                </pre>-->
<!--            </div>-->
        </div>

    </div>


</div>
