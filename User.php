<?php
require_once 'ManageData.php';

class User
{
    public static function register($firstName, $lastName, $email, $password)
    {
        $dataManager = new ManageData();

        $query = 'SELECT * FROM users WHERE email = :email';
        $user = $dataManager->getData($query, [':email' => $email], true);

        if (!empty($user)) {
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = 'INSERT INTO users(first_name, last_name, email, password)
                  VALUES(:first_name, :last_name, :email, :password)';

        $dataManager->executeQuery($query, [
            ':first_name' => $firstName,
            ':last_name' => $lastName,
            ':email' => $email,
            ':password' => $hashedPassword
        ]);

        return self::login($email, $password);
    }

    public static function login($email, $password)
    {
        $dataManager = new ManageData();

        $query = 'SELECT * FROM users WHERE email = :email';
        $user = $dataManager->getData($query, [':email' => $email], true);

        if (empty($user)) {
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            return false;
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['first_name'];

        return true;
    }

    public static function checkLoggedInUser()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['user_id']);
    }

    public static function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();
    }
}
