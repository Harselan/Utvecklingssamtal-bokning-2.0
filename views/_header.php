<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/assets/css/main.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/form.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/phone.css">
        <title>Utvecklingssamtal 2.0</title>
    </head>
    <body>
        <?php if( isset( $_SESSION['name'] ) ): ?>
        <div class="wrapper">
            <ul class="nav">
                <li><a href="/">Hem</a></li>
                <li><a href="/account/<?=$_SESSION['user_id']?>"><?=$_SESSION['name']?></a></li>
                <?php if( User::get( $_SESSION['user_id'] )['state_id'] == 2 ): ?>
                <li><a href="/places">Arbetsplatser</a></li>
                <li><a href="/workhistory">Arbetslogg</a></li>
                <li><a href="/history">Logg</a></li>
                <li><a href="/reports">Rapport</a></li>
                <li class="nav-right" style="float:right;"><a href="/logout">Logga ut</a></li>
            </ul>
                <form action="/search" class="search-form" method="post">
                    <input type="text" name="search" placeholder="Sök här...">
                    <button type="submit">Sök</button>
                </form>
                <?php elseif( User::get( $_SESSION['user_id'] )['state_id'] == 1 ): ?>
                    <li class="nav-right" style="float:right;"><a href="/logout">Logga ut</a></li>
            </ul>
            <?php endif; ?>
        <?php endif; ?>
