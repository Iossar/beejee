<?php


namespace app\Controllers;


use app\Models\User;
use app\Models\View;

class UserController
{
    public function registration()
    {
        $post = $_POST;
        if (!empty($post)) {
            $user = new User();
            $user->login = htmlspecialchars(trim($post['login']));
            $user->email = htmlspecialchars(trim($post['email']));
            $user->password =  password_hash(htmlspecialchars(trim($post['password'])),PASSWORD_DEFAULT);
            if ($user->save()) {
                header("Location: /");
            }
        }
        echo View::render(['title' => 'Registration', 'method_view' => 'user/registration', 'method_data' => []]);
    }

    public function login()
    {
        $post = $_POST;
        if (!empty($post)) {
            $login = htmlspecialchars($post['login']);
            $user = User::where('login', 'LIKE', $login)->first();
            if ($user && password_verify($post['password'], $user->password)) {
                $_SESSION['logged_user'] = $user;
                header("Location: /");
            } else {
                $_SESSION['failed'] = true;
            }
        }
        echo View::render(['title' => 'Login', 'method_view' => 'user/login', 'method_data' => []]);
    }


    public function logout()
    {
        $_SESSION = [];
        session_destroy();
        header("Location: /");
    }
}
