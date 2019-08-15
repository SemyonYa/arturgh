<?php

use app\models\Client;

/**
 * @var $clients Client[]
 */
?>

<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="SelectParentModalLabel">От кого пришёл</h4>
        </div>
        <div class="modal-body">
            <div>
                <input class="form-control" type="text" placeholder="Поиск..." autofocus="autofocus" oninput="FilteringParentList(this)" />
            </div>
            <div class="parent-list">
                <?php foreach ($clients as $client): ?>
                    <div class="parent-item <?= ($parent_id === $client->parent_id) ? 'parent-item-selected' : '' ?>"
                         onclick="SelectParent(<?= $client->id ?>, '<?= $client->fioSnils ?>')"><?= $client->fioSnils ?></div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
        </div>
    </div>
</div>