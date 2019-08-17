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

}