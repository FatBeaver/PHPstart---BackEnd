<?php 
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/Product.php';

class SiteController 
{
    public function actionIndex()
    {      
        $categories = Category::getCategoriesList();
        $latestProduct = Product::getLatestProducts(12);
        $recomendedProducts = Product::getProductsIsRecomended();    
        echo "<pre>";
        print_r($recomendedProducts);
        echo "</pre>";
       

        require_once __DIR__ . '/../views/site/index.php';
        return true;
    }

    public function actionContact()
    {   
        $userEmail = '';
        $userText  = '';
        $result = false;

        if (isset($_POST['submit'])) {

            $userEmail = $_POST['userEmail'];
            $userText  = $_POST['userText'];

            $errors = false;

            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Неправильный Email';
            }

            if ($errors == false) {
                $mail = 'Caja <childrenofbodom737@gmail.com>';
                $subject = 'Тема письма';
                $message = "Текст: {$userText}. От {$userEmail}";
                $result = mail($mail, $subject, $message);
                $result = true;
            }
        }
        
        require_once __DIR__ . '/../views/site/contact.php';
        return true;
    }
}