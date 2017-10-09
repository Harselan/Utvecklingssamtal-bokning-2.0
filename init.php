<?php

setlocale(LC_ALL, "swedish");
date_default_timezone_set('Europe/Stockholm');

# Include all config files
require_once($_SERVER['DOCUMENT_ROOT'] . '/configs/sessions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/configs/functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/configs/database.php');

# Include database class
require_once($_SERVER['DOCUMENT_ROOT'] . '/configs/DB.php');
# Initiate database;
DB::init();

# Include all models
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/user.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/calendar.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/work.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/history.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/search.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/report.php');

# Include the route system
require_once($_SERVER['DOCUMENT_ROOT'] . '/routes/route.php');

#Routes
require_once($_SERVER['DOCUMENT_ROOT'] . '/routes/web.php');

#Controllers
require_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/DashboardController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/LoginController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/UserController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/WorkController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/HistoryController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/ReportController.php');

# Runs all routes
Route::run();
?>
