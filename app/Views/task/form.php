<?php
use app\Models\User;
?>
<a href="/" class="card-link">Back</a> <br>
<div class="m-3 col-md-4">
    <form action="/task/edit/<?= $task->id ?>" method="post">
        <div class="form-group">
            <label for="text">Text</label>
            <input type="text" class="form-control" id="text" placeholder="text" name="text" value="<?= $task->text ?>" required>
        </div>
        <div class="form-group">
            <label for="username">Author name</label>
            <input type="text" class="form-control" id="username" placeholder="Author name" name="username" value="<?= $task->username ?>" required>
        </div>
        <div class="form-group">
            <label for="username">Author email</label>
            <input type="email" class="form-control" id="username" placeholder="Author email" name="email" value="<?= $task->email ?>" required>
        </div>
        <?php if (User::isAdmin()) : ?>
        <div class="dropdown mb-2">
            <select class="form-control" name="status">
                <?php foreach ($statuses as $key => $status) : ?>
                    <option value="<?= $key ?>"  <?=($task->status == $key) ? "selected='selected'" : '';?>><?= $status ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
