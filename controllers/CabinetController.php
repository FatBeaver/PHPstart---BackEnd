<?php 

class CabinetController
{
    public function actionIndex()
    {
        $userId = User::checkLogged();

        $user = User::getUserById($userId);

        require_once ROOT . '/views/cabinet/index.php';

        return true;
    }

    public function actionEdit()
    {   
        $userId = User::checkLogged();

        $user = User::getUserById($userId);

        $name = $user['name'];
        $password = $user['password'];

        $result = false;

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
                $result = User::edit ($userId, $name, $password);
            }
        }
        require_once ROOT . '/views/cabinet/edit.php';

        return true;
    }
}