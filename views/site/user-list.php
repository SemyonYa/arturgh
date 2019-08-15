<?php
use app\models\User;

/**
 * @var $users User[]
 * @var $this \yii\web\View
 */
$this->title = 'Список пользователей';
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= $this->title ?></h2>

<a href="/signup" class="btn btn-primary">Регистрация нового пользователя</a>

<table class="crud-table">
    <thead>
    <tr>
        <td>ID</td>
        <td>Имя пользователя</td>
        <td>Роль</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?= $user->id ?></td>
        <td><?= $user->username ?></td>
        <td><?= $user->role ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>