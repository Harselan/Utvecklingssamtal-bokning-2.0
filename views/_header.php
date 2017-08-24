<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>app.docci.se</title>
        <link rel="icon" type="image/png" href="<?= assets('/img/favicon.ico') ?>">
        <link href="<?= assets('/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?= assets('/css/main.css') ?>" rel="stylesheet">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php if($_SERVER['REQUEST_URI'] != "/login" && $_SERVER['REQUEST_URI'] != "/verify"): ?>
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div id="navbar" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="/dashboard">Hem</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Konto <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="/user">Inställningar</a></li>
                                    <li><a href="/history">Logg</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="/logout">Logga ut</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        <?php endif; ?>
        <div class="container">
            <div class="row">
