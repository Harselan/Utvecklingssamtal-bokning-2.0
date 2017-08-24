<?php
$directoryname = "Utvecklingssamtal-bokning-2.0";
# Include all config files
require_once($_SERVER['DOCUMENT_ROOT'] . '/' . $directoryname . '/configs/sessions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/' . $directoryname . '/configs/functions.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/' . $directoryname . '/configs/database.php');

# Include database class
require_once($_SERVER['DOCUMENT_ROOT'] . '/' . $directoryname . '/configs/DB.php');
# Initiate database;
DB::init();

# Include all models
// require_once($_SERVER['DOCUMENT_ROOT'] . '/models/email.php');

# Include the route system
require_once($_SERVER['DOCUMENT_ROOT'] . '/' . $directoryname . '/routes/route.php');

#Routes
require_once($_SERVER['DOCUMENT_ROOT'] . '/' . $directoryname . '/routes/web.php');

#Controllers
require_once($_SERVER['DOCUMENT_ROOT'] . '/' . $directoryname . '/controllers/DashboardController.php');

# Runs all routes
Route::run();
?>
