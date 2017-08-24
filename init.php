<?php
define( 'DIRECTORY_NAME', 'Utvecklingssamtal-bokning-2.0' );
# Include all config files
require_once($_SERVER['DOCUMENT_ROOT'] . '/' . DIRECTORY_NAME . '/configs/sessions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/' . DIRECTORY_NAME . '/configs/functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/' . DIRECTORY_NAME . '/configs/database.php');

# Include database class
require_once($_SERVER['DOCUMENT_ROOT'] . '/' . DIRECTORY_NAME . '/configs/DB.php');
# Initiate database;
DB::init();

# Include all models
// require_once($_SERVER['DOCUMENT_ROOT'] . '/models/email.php');

# Include the route system
require_once($_SERVER['DOCUMENT_ROOT'] . '/' . DIRECTORY_NAME . '/routes/route.php');

#Routes
require_once($_SERVER['DOCUMENT_ROOT'] . '/' . DIRECTORY_NAME . '/routes/web.php');

#Controllers
require_once($_SERVER['DOCUMENT_ROOT'] . '/' . DIRECTORY_NAME . '/controllers/DashboardController.php');

# Runs all routes
Route::run();
?>
