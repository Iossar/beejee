<a href="/" class="card-link">Back</a> <br>
<div class="m-3 col-md-4">
    <?php if (!empty($_SESSION['failed'])) : ?>
        <div class="card text-start p-2 m-2" style="color: #b14545">
            Неправильные email/пароль
        </div>
        <?php unset($_SESSION['failed']) ?>
    <?php endif; ?>
    <form action="/login" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
