<?php
declare(strict_types=1);

define('DB_SUCCESS', '0');
define('DB_PASS_NOT_MATCH', '1');
define('DB_DUP_VAL', '23000');

/**
 * Authorizes login details and returns id on success and false on failure
 */
function authorize_user_login(string $email, string $password): bool|int {
    global $pdo;

    $stmt = $pdo->prepare('SELECT * FROM `users` WHERE `email` = :email');
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user !== false && password_verify($password, $user['password_hash'])) {
        return $user['id'];
    }
    return false;
}

/**
 * Register user and validate credentials. Returns status code
 */
function register_user(string $email, string $password, string $confirm): string {
    global $pdo;

    // TODO: Add more server-side validation
    if ($password !== $confirm) {
        return DB_PASS_NOT_MATCH;
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    try {
        $stmt = $pdo->prepare('INSERT INTO `users` (`email`, `password_hash`) VALUES (:email, :password_hash)');
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password_hash', $password_hash);
        $stmt->execute();
    } catch (PDOException $e) {
        return $e->getCode();
    }
    return DB_SUCCESS;
}

