<?php 

class Product
{
    const SHOW_BY_DEFAULT = 2;

    /**
     * Returns an array of products
    */
    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);

        $db = Db::getConnection();

        $productsList = array();

        $result = $db->query("SELECT id, name, price, image, is_new FROM product "
                        . "WHERE status = 1 "
                        . "ORDER BY id DESC "
                        . "LIMIT " . $count . "");
        
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $productsList[$i]['image'] = $row['image'];
            $i++;
        }

        return $productsList;
    }


    public static function getProductsListByCategory($categoryId = false, $page = 1)
    {
        if ($categoryId) {

            $page  = intval($page);

            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

            $db = Db::getConnection();

            $products = array();

            $result = $db->query("SELECT id, name, price, image, is_new FROM product "
                            . "WHERE status = 1 AND category_id = $categoryId "
                            . "ORDER BY id DESC "
                            . "LIMIT " . self::SHOW_BY_DEFAULT
                            . " OFFSET " . $offset . "");
            
            $i = 0;
            while ($row = $result->fetch()) {
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['is_new'] = $row['is_new'];
                $products[$i]['image'] = $row['image'];
                $i++;
            }

            return $products;
        }
    } 


    public static function getProductById($id)
    {
        $id = intval($id);

        if ($id) {
            $db = Db::getConnection();

            $result = $db->query("SELECT * FROM product WHERE id = $id ");
            $result->setFetchMode(PDO::FETCH_ASSOC);
           
            return $result->fetch();
        }  
    }

    public static function getTotalProductsInCategory($categoryId)
    {
        $db = Db::getConnection();

        $result = $db->query("SELECT count(id) AS count FROM product " 
                            . "WHERE status = 1 AND category_id = " . $categoryId );
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }


    public static function getProductsById($IDsArray)
    {
        $products = [];

        $db = Db::getConnection();

        $IDsString = implode(',', $IDsArray);

        $sql = "SELECT * FROM product WHERE status = 1 AND id IN ($IDsString)";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }

        return $products;
    }

    public static function getProductsIsRecomended()
    {
        $db = Db::getConnection();

        $sql = "SELECT * FROM product WHERE status = 1 AND is_recommended = 1";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;
        while($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }

        return $products;
    }

    public static function getProductsList()
    {
        $db = Db::getConnection();

        $result = $db->query("SELECT id, name, price, code FROM product ORDER BY id ASC");
        $productsList = [];
        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['code'] = $row['code'];
            $i++;
        }

        return $productsList;
    }

    public static function deleteProductById($id)
    {
        $db = Db::getConnection();

        $sql =  "DELETE FROM product WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        return true;
    }

    public static function createProduct($options)
    {
        
        $db = Db::getConnection();
        
        $sql = "INSERT INTO product "
                . "(name, code, price, category_id, brand, availability, "
                . "description, is_new, image, is_recommended, status) "
                . "VALUES "
                . "(:name, :code, :price, :category_id, :brand, :availability, "
                . ":description, :is_new, :image, :is_recommended, :status)";
        
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_INT);
        $result->bindParam(':price', $options['price'], PDO::PARAM_INT);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindValue(':image', null, PDO::PARAM_NULL);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
       // print_r($result->errorInfo());
            
        if ($result->execute()) {   
            return $db->lastInsertId();
            
        }
        return 0;
    }


    public static function updateProduct($id, $options)
    {
        $db = Db::getConnection();

        $sql = "UPDATE product SET "
                . "name = :name "
                . "code = :code"
                . "price = :price"
                . "category_id = :category_id"
                . "brand = :brand"
                . "image = :image"
                . "availability = :availability"
                . "description = :description"
                . "is_new = :is_new"
                . "is_recommended = :is_recommended"
                . "status = :status "
                . "WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_STR);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':image', $_FILES['image']['name'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_STR);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        return $result->execute();
    }

    public static function getAvailabilityText($availability)
    {
        switch ($availability) {
            case '1':
                return 'В наличии';
                break;
            case '0':
                return 'Под заказ';
                break;
        }
    }
    /**
     * Возвращает путь к изображению
     * @param integer $id
     * @return string <p>Путь к изображению</p>
     */
    public static function getImage($id)
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';
        // Путь к папке с товарами
        $path = '/upload/images/products/';
        // Путь к изображению товара
        $pathToProductImage = $path . $id . '.jpg';
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToProductImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        }
        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }
}
