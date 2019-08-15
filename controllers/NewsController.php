<?php 
require_once __DIR__ . '/../models/News.php';

class NewsController 
{   
    public function actionIndex()
    {
        $newsList = array();
        $newsList = News::getNewsList();

        require_once __DIR__ . '/../views/news/index.php';
        return  true;
    }

    public function actionView($category, $id)
    {   
        $newsItem = array();
        $newsItem = News::getNewsItemById($id);

        return true;
    }
    
}