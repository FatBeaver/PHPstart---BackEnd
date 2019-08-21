<?php 

class AdminOrderController extends AdminBase
{
    public function actionIndex()
    {
        self::checkAdmin();

        require_once ROOT . '/views/admin_order/index.php';

        return true;
    }
}