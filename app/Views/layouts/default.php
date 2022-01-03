<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php \vendor\core\base\View::getMeta(); ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

    <title>Auth</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active" <?php echo ($condition == true) ? 'visible' : 'hidden'; ?>>
                <a class="btn btn-default" href="/user/signup">singup</a>
            </li>
            <li class="nav-item active" <?php echo ($condition == true) ? 'visible' : 'hidden'; ?>>
                <a class="btn btn-default" href="/user/login">login</a>
            </li>

            <li class="nav-item active" <?php echo ($condition == false) ? 'visible' : 'hidden'; ?>>
                <a class="btn btn-default" href="/">Main</a>
            </li>
            <li class="nav-item" <?php echo ($condition == false) ? 'visible' : 'hidden'; ?>>
                <a class="btn btn-default"
                   href="/cabinet/">My gallery</a>
            </li>
            <li class="nav-item" <?php echo ($condition == false) ? 'visible' : 'hidden'; ?>>
                <form method="POST" action="/user/logout">
                    <div>
                        <input type="hidden" name="logout">
                    </div>
                    <div>
                        <button class="btn btn-default ml-3">Loguot</button>
                    </div>
                </form>
            </li>
        </ul>
    </div>
</nav>
<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['error'];
        unset($_SESSION['error']) ?></div>
<?php endif; ?>
<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= $_SESSION['success'];
        unset($_SESSION['success']) ?></div>
<?php endif; ?>
<?= $content ?>

</body>
</html>

