<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php \vendor\core\base\View::getMeta();?>
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
            <li class="nav-item active">
                <a class="btn btn-default" href="#">Main</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-default"
                   href="#">My gallery</a>
            </li>
            <li class="nav-item">
                <form method="POST" action="#">
                    <div>
                        <input type="hidden" name="logout" value="1">
                    </div>
                    <div>
                        <button class="btn btn-default" value="1">Loguot</button>
                    </div>
                </form>
            </li>
        </ul>
    </div>
</nav>
<?=$content?>