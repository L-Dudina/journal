<?php
// Включаем вывод ошибок
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Подключаем все наши общие классы: Модель, Контроллер и Представление
require_once 'core/Model.php';
require_once 'core/View.php';
require_once 'core/Controller.php';

// Подключаем также Роутинг и запускаем его маршрутизатор
require_once 'core/Route.php';

Route::start(); // Запускаем маршрутизатор
?>
