<?php 

return [
    //Товары
    'product/([0-9]+)' => 'product/view/$1',
    //Каталог
    'catalog' => 'catalog/index',
    //Категория товаров
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2',
    'category/([0-9]+)' => 'catalog/category/$1',

    'user/register' => 'user/register',
    '' => 'site/index',
];