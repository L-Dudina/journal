<?php 
class Route 
{ 
    // Метод для получения массива частей пути (роутинга)
    public static function getPathArray() { 
        $BASE_URL = 'localhost/journal/';  // Базовый URL для роутинга
        $pathArray = [];  // Массив вложенности

        // Получаем текущий адрес
        $currentPath = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        
        // Проверяем, что текущий путь содержит базовый URL
        if (strpos($currentPath, $BASE_URL) !== false) {
            $tmpPath = substr($currentPath, strlen($BASE_URL));  // Убираем базовый URL из пути
        } else {
            $tmpPath = $currentPath;  // Если URL не совпадает с BASE_URL, используем полный путь
        }

        // Разбиваем URI на части
        $tmpArray = explode("/", $tmpPath);

        // Массив, который нам возвращает explode, содержит пустые значения.
        // Нам нужно отфильтровать их. У нас два варианта решения:
        // Либо через цикл foreach, либо используя фильтрацию массива.
        /*
        foreach ($tmpArray as $key => $item) { 
            if (strlen($item) > 0) { 
                array_push($pathArray, $item); 
            } 
        }
        */
        
        // Воспользуемся функцией фильтра значений массива, убираем пустые элементы
        $pathArray = array_values(array_filter($tmpArray, function($element) {
            return !empty($element);
        }));

        // Обязательно обернуть в array_values для сброса индексации.
        // Возвращаем полученный список элементов URI
        return $pathArray; 
    } 

    // Метод для запуска маршрутизации
    public static function start() { 
        // Указываем контроллер и действие по умолчанию
        $controller_name = 'News'; 
        $action_name = 'index'; 
        
        // Получаем массив с роутингом
        $routes = self::getPathArray(); 
        
        // Получаем имя контроллера, если оно есть
        if (!empty($routes[0])) { 
            $controller_name = ucfirst($routes[0]);  // Делаем первую букву заглавной
        } 
        
        // Получаем имя действия, если оно указано в запросе
        if (!empty($routes[1])) { 
            $action_name = $routes[1]; 
        } 

        // Добавляем префиксы к именам контроллера и действия
        $model_name = 'Model_' . $controller_name; 
        $controller_name = 'Controller_' . $controller_name; 
        $action_name = 'action_' . $action_name; 
        
        // Подключаем файл модели (если он существует)
        $model_file = strtolower($model_name) . '.php'; 
        $model_path = "models/" . $model_file; 
        if (file_exists($model_path)) { 
            include $model_path; 
        } 
        
        // Подключаем файл контроллера
        $controller_file = strtolower($controller_name) . '.php'; 
        $controller_path = "controllers/" . $controller_file; 
        if (file_exists($controller_path)) { 
            include $controller_path; 
        } else { 
            // Если контроллер не найден, показываем страницу 404
            self::ErrorPage404(); 
            return; 
        } 
        
        // Создаем экземпляр контроллера
        $controller = new $controller_name; 
        $action = $action_name; 
        
        // Если метод контроллера существует, вызываем его
        if (method_exists($controller, $action)) { 
            $controller->$action();  // Вызываем действие контроллера
        } else { 
            // Если метод не найден, показываем страницу 404
            self::ErrorPage404(); 
        } 
    } 
    
    // Метод для редиректа на страницу 404 при ошибке
    public static function ErrorPage404() { 
    $host = 'http://' . $_SERVER['HTTP_HOST'] . '/journal/'; 
    header('HTTP/1.1 404 Not Found'); 
    header('Status: 404 Not Found'); 
    header('Location: ' . $host . '404'); 
}
} 
?>
