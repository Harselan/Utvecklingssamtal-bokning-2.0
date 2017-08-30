<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/assets/css/main.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/form.css">
        <title>Utvecklingssamtal 2.0</title>
    </head>
    <body>
        <?php if( isset( $_SESSION['name'] ) ): ?>
        <div class="wrapper">
            <ul class="nav">
                <li><a href="/">Hem</a></li>
                <li><a href="/account/<?=$_SESSION['user_id']?>"><?=$_SESSION['name']?></a></li>
                <li class="nav-right" style="float:right;"><a href="/logout">Logga ut</a></li>
                <li><a href="/history">Logg</a></li>
            </ul>
        </div>
        <?php endif; ?>
