<div class="col-md-12">
    <div class="p-2 text-right">
        <?php if (empty($_SESSION['logged_user'])) : ?>
            <a href="/login" class="btn btn-primary">Login</a>
            <a href="/registration" class="btn btn-primary">Registration</a>
        <?php else: ?>
            <a href="/logout" class="btn btn-primary">Logout</a>
        <?php endif; ?>
    </div>
    <div class="p-2">
        <a href="/task/add" class="btn btn-primary">Add task</a>
    </div>
    <?php if (!empty($_SESSION['success'])) : ?>
        <div class="card text-start p-2 m-2" style="color: mediumseagreen">
            Task was added successfully
        </div>
        <?php unset($_SESSION['success']) ?>
    <?php endif; ?>

    <div class="p-2">
        <a class="btn btn-primary" href="/?<?= http_build_query(array_merge($params, ['column' => 'username', 'order' => $order])) ?>">Sort by name</a>
        <a class="btn btn-primary" href="/?<?= http_build_query(array_merge($params, ['column' => 'email', 'order' => $order])) ?>">Sort by email</a>
        <a class="btn btn-primary" href="/?<?= http_build_query(array_merge($params, ['column' => 'status', 'order' => $order])) ?>">Sort by status</a>
        <?php if (!empty($params)) : ?>
        <a class="btn btn-success" href="/">Remove sort</a>
        <?php endif; ?>
    </div>



    <?php foreach ($tasks as $task) : ?>
        <div class="card text-start p-2 m-2">
            <a href="/task/show/<?= $task->id ?>" class="card-title card-link"> Задача #<?= $task->id ?>
                <span class="text-muted"> <?= ($task->status == 'ready') ? 'Готова' : 'В процессе' ?> </span>
                <?php if ($task->is_edited) : ?>
                    <span class="text-muted"> | Отредактировано администратором </span>
                <?php endif; ?>
            </a>
            <div class="pb-2"> <?= $task->text ?> </div>
            <div class="card-subtitle mb-2 text-muted">Автор: <?= $task->username ?> (<?= $task->email ?>)</div>

        </div>
    <?php endforeach; ?>

    <div class=" text-start p-2 m-2 col-md-1">
        <?php for ($page = 1; $page <= $num_pages; $page++) : ?>
            <?php if ($cur_page == $page) : ?>
                <b style="border: 1px solid black" class="p-1 card-link"><?= $page ?></b>
            <?php else: ?>
                <a style="border: 1px solid black" class="p-1 card-link"
                   href="/?<?= http_build_query(array_merge($params, ['page' => $page])) ?>"><?= $page ?></a>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
</div>
