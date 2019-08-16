<?php 

class Router 
{
    private $routes; // Роуты загруженные конструктором из файла routes.php

    public function __construct()
    {
        $routesPath = __DIR__ . '/../config/routes.php';  
        $this->routes = include($routesPath);
    }

    public function run()
    {
        //  1. Получаем строку запроса от пользователя
        $uri = $this->getURI();
        //  2. Проход по всем роутам в массиве $routes с дальнейшим поиском совпадений
        foreach($this->routes as $uriPattern => $path)
        {      
            
            // 2.1 Сравнение данных из строки запроса с каждым роутом из массива $routes
            if (preg_match("`$uriPattern$`", $uri))
            {   
                // 2.2 Получение внутреннего пути из внешнего согласно правилу regExp
                $internalRoute = preg_replace("`$uriPattern$`", $path, $uri);
              
                // 2.3 Определение контроллера, экшена и параметров для обработки запроса
                $segmentsRoute = explode('/', $internalRoute);
             
                $controllerName = array_shift($segmentsRoute) . 'Controller';
                $controllerName = ucfirst($controllerName);     // Собираем имя контроллера
               
                $actionName = 'action' . ucfirst(array_shift($segmentsRoute));    // Собираем имя экшена
                
                $parameters = $segmentsRoute; // Присвиваем переменной $parameters оставшиеся ячейки массива (параметры)

                // Получение пути до файла с нужным контроллером 
                $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php'; 

                if (file_exists($controllerFile)) { // Если файл контроллера существует

                    include_once($controllerFile); // Подключаем Файл с Полученным контроллером
                }

                $controllerObject = new $controllerName; // Cоздание экземпляра контроллера по собранному имени

                $result = call_user_func_array([$controllerObject, $actionName], $parameters);
                
                if ($result != null) {
                    break;
                }
            }

        }
    }



    /**
     * @return request string
     * 
     * Return requests string
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {

            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

}