<?php

require __DIR__ . '/inc/all.inc.php';

if (empty($_SESSION['userId'])) {
    header('Location: login.php');
    die();
}
$classes = fetch_upcoming_schedule($id);

render('home.view', 'dashboard.view', [
    'classes' => $classes,
    'scripts' => [
        'hamburger.js'
    ]
]);