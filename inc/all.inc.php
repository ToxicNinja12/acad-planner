<?php
define('VIEW_LOGIN', 0);
define('VIEW_SIGNUP', 1);
session_start();
$id = $_SESSION['userId'] ?? null;

date_default_timezone_set('Asia/Kolkata');

require __DIR__ . '/db-connect.inc.php';
require __DIR__ . '/functions.inc.php';
require __DIR__ . '/auth.inc.php';
require __DIR__ . '/timetable.inc.php';