<?php 

class News
{
    public static function getNewsItemById($id)
    {
        $id = intval($id);

        if ($id) {
            
            $db = Db::getConnection();

            $result = $db->query("SELECT * FROM news WHERE id = " . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $newsItem = $result->fetch();

            return $newsItem;
        }
    }

    /**
     * @return array
     * 
     * Выборка последних десяти записей из таблицы news
     */
    public static function getNewsList()
    {   
        $db = Db::getConnection();

        $newList = array();

        $result = $db->query('SELECT id, title, date, short_content '
                        . 'FROM news '
                        . 'ORDER BY date DESC '
                        . 'LIMIT 10');

        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i = 0;
        while ($row = $result->fetch()) {
            $newList[$i]['id'] = $row['id'];
            $newList[$i]['title'] = $row['title'];
            $newList[$i]['date'] = $row['date'];
            $newList[$i]['short_content'] = $row['short_content'];
            $i++;
        }

        return $newList;
    }

}