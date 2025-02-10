<?php

require __DIR__ . '/inc/all.inc.php';

if (!empty($_SESSION['userId'])) {
    header('Location: dashboard.php');
    die();
}

if (!empty($_POST)) {
    $email = (string) ($_POST['email'] ?? '');
    $password = (string) ($_POST['password'] ?? '');

    $id = authorize_user_login($email, $password);
    if ($id !== false) {
        $_SESSION['userId'] = $id;
        header('Location: dashboard.php');
        die();
    }
    else {
        render('auth.view', 'main.view', [
            'type' => VIEW_LOGIN,
            'passwordError' => true,
            'scripts' => [
                'form-validate.js'
            ]
        ]);
        die();
    }
}

render('auth.view', 'main.view', [
    'type' => VIEW_LOGIN
]);