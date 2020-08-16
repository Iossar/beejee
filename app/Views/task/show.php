<?php
use app\Models\User;
?>
<a href="/" class="card-link">Back</a> <br>
<div class="card text-start p-2 m-2 col-md-4">
    <span class="card-title card-link"> Задача #<?= $task->id ?> <span class="text-muted"> <?= ($task->status == 'ready') ? 'Готова' : 'В процессе' ?> </span> </span>
    <span class="card-title"><?= $task->text ?></span>
    <div class="card-subtitle mb-2 text-muted">Автор: <?= $task->username ?></div>
</div>
<?php if (User::isAdmin()) : ?>
    <a href="/task/edit/<?= $task->id ?>" class="btn btn-primary">Edit</a>
<?php endif; ?>
