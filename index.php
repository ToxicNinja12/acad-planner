<?php

require __DIR__ . '/inc/all.inc.php';

if (!empty($_SESSION['userId'])) {
    header('Location: dashboard.php');
    die();
}

render('landing.view', 'main.view', [
    'landing' => true
]);