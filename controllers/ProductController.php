<?php 
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Category.php';

class ProductController
{
    public function actionView($id)
    {   

        $categories = Category::getCategoriesList();
        $product    = Product::getProductById($id);

        require_once __DIR__ . '/../views/product/view.php';

        return true;
    }
}