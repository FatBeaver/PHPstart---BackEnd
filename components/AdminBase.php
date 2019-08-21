<?php 

class AdminBase 
{
    public static function checkAdmin()
    {
        $userID = User::checkLogged();

        $user = User::getUserById($userID);

        if ($user['admin'] === 'admin') {
            return true;
        }

        die('Access denied');
    }
}