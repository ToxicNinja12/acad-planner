<?php

require __DIR__ . '/inc/all.inc.php';

if (empty($_SESSION['userId'])) {
    header('Location: login.php');
    die();
}

if (!empty($_POST['classes'])) {
    update_timetable($id, $_POST['classes']);
}

$classes = fetch_timetable($id);
$subjects = fetch_subjects($id);

render('timetable.view', 'dashboard.view', [
    'classes' => $classes,
    'subjects' => $subjects,
    'scripts' => [
        'hamburger.js',
        'timetable.js'
    ],
    'apis' => [
        'https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'
    ]
]);