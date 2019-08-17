<?php 
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/Product.php';

class SiteController 
{
    public function actionIndex()
    {      
        $categories = Category::getCategoriesList();
        $latestProduct = Product::getLatestProducts(12);

        require_once __DIR__ . '/../views/site/index.php';
        return true;
    }
}