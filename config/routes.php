<?php 

return [
    //Товар
    'product/([0-9]+)' => 'product/view/$1',
    //Каталог
    'catalog' => 'catalog/index',
    //Категория товаров
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2',
    'category/([0-9]+)' => 'catalog/category/$1',
    //Пользователь
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'user/register' => 'user/register',
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',
    //Email
    'contacts' => 'site/contact',
    //Корзина товаров
    'cart/add/([0-9]+)' => 'cart/add/$1',
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1',
    'cart' => 'cart/index',
    'cart/checkout' => 'cart/checkout',
    'cart/delete/([0-9]+)' => 'cart/delete/$1',
    
    //Страница администратора
    'admin' => 'admin/index',
    //Управление товарами
    'admin/product/create' => 'adminProduct/create',
    'admin/product/update' => 'adminProduct/update/$1',
    'admin/product/delete' => 'adminProduct/delete/$1',
    'admin/product' => 'adminProduct/index',
    //Управление категориями
    'admin/category/create' => 'adminCategory/create',
    'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
    'admin/category/create/([0-9]+)' => 'adminCategory/delete/$1',
    'admin/category' => 'adminCategory/index',
    //Управление заказами
    'admin/order/update/([0-9]+)' => 'adminOrder/update/$1', 
    'admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1',
    'admin/order/view' => 'AdminOrder/view/$1',
    'admin/order' => 'adminOrder/index',

    //Главная страница
    '' => 'site/index',
];