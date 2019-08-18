<?php 

class UserController
{
    public function actionRegister()
    {   
        $name = '';
        $email = '';
        $password = '';

        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2х символов';
            }

            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный Email!';
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Имя не должно быть короче 6ти символов';
            }

            if (User::checkEmailExist($email)) {
                $errors[] = 'Такой Email уже используется.';
            }
            
            if ($errors == false) {
                $result = User::register($name, $password, $email);
            }
        }

        require_once ROOT . '/views/user/register.php';
        return true;
    }

    public function actionLogin()
    {
        $email = '';
        $password = '';

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный Email';
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Неправильный пароль (Пароль должен быть НЕ короче 6-ти символов)';
            }

            $userId = User::checkUserData($email, $password);
    
            if ($userId == false) {

                $errors[] = 'Не правльные данные для входа на сайт.';
            } else {

                User::auth($userId);
                header('Location: /cabinet/');
            }
        }

        require_once ROOT . '/views/user/login.php';

        return true;
    }

    public function actionLogout()
    {
        session_start();
        unset($_SESSION['user']);
        header('Location: /');
    }

}