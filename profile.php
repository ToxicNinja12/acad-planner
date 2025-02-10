<?php

require __DIR__ . '/inc/all.inc.php';

if (empty($_SESSION['userId'])) {
    header('Location: login.php');
    die();
}

if (!empty($_POST['remove'])) {
    remove_subjects($id, $_POST['remove']);
}
if (!empty($_POST['code']) && !empty($_POST['name'])) {
    $subjects = array_combine($_POST['code'], $_POST['name']);
    insert_subjects($id, $subjects);
}

$userInfo = fetch_userinfo($id);
$subjects = fetch_subjects($id);

render('profile.view', 'dashboard.view', [
    'name' => $userInfo['name'],
    'email' => $userInfo['email'],
    'subjects' => $subjects,
    'scripts' => [
        'hamburger.js',
        'table.js'
    ]
]);