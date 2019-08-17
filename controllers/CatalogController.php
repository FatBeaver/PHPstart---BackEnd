<?php 

class CatalogController 
{

    public function actionIndex()
    {      
        $categories = Category::getCategoriesList();
        $latestProduct = Product::getLatestProducts(5);

        require_once __DIR__ . '/../views/catalog/index.php';
        return true;
    }

    
    public function actionCategory($categoryId, $page = 1)
    {
        $categories = array();
        $categories = Category::getCategoriesList();

        $categoryProducts = array();
        $categoryProducts = Product::getProductsListByCategory($categoryId, $page);

        $total = Product::getTotalProductsInCategory($categoryId);

        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        require_once __DIR__ . '/../views/catalog/category.php';
        return true;
    }

}