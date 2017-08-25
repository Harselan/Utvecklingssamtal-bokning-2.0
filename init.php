<?php
# Include all config files
require_once($_SERVER['DOCUMENT_ROOT'] . '/configs/sessions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/configs/functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/configs/database.php');

# Include database class
require_once($_SERVER['DOCUMENT_ROOT'] . '/configs/DB.php');
# Initiate database;
DB::init();

# Include all models
// require_once($_SERVER['DOCUMENT_ROOT'] . '/models/email.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/user.php');

# Include the route system
require_once($_SERVER['DOCUMENT_ROOT'] . '/routes/route.php');

#Routes
require_once($_SERVER['DOCUMENT_ROOT'] . '/routes/web.php');

#Controllers
require_once($_SERVER['DOCUMENT_ROOT'] . '/controllers/DashboardController.php');

# Runs all routes
Route::run();
?>
