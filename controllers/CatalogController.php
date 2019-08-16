<?php 
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/Product.php';

class CatalogController 
{

    public function actionIndex()
    {      
        $categories = Category::getCategoriesList();
        $latestProduct = Product::getLatestProducts(15);

        require_once __DIR__ . '/../views/catalog/index.php';
        return true;
    }

    
    public function actionCategory($categoryId)
    {
        $categories = array();
        $categories = Category::getCategoriesList();

        $categoryProducts = array();
        $categoryProducts = Product::getProductsListByCategory($categoryId);

        require_once __DIR__ . '/../views/catalog/category.php';
        return true;
    }

}