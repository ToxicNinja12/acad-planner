<?php

require __DIR__ . '/inc/all.inc.php';

if (!empty($_SESSION['userId'])) {
    header('Location: dashboard.php');
    die();
}

if (!empty($_POST)) {
    $email = (string) ($_POST['email'] ?? '');
    $password = (string) ($_POST['password'] ?? '');
    $confirm = (string) ($_POST['confirm'] ?? '');
    $params = [
        'type' => VIEW_SIGNUP,
        'scripts' => [
            'form-validate.js'
        ]
    ];

    $errCode = register_user($email, $password, $confirm);
    switch ($errCode) {
        case DB_SUCCESS:
            // Registration successful.
            $_SESSION['userId'] = $id;
            header('Location: dashboard.php');
            die();
            break;
        case DB_PASS_NOT_MATCH:
            $params['passwordError'] = true;
            break;
        case DB_DUP_VAL:
            $params['emailError'] = true;
            break;
        default:
            die('SQL ERROR CODE: ' . $errCode);
            break;
    }
    
    render('auth.view', 'main.view', $params);
    die();
}

render('auth.view', 'main.view', [
    'type' => VIEW_SIGNUP
]);