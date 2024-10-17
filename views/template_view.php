<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Сайт'; ?></title>
    <link rel="stylesheet" href="css/style.css"> <!-- Подключение стилей -->
</head>
<body>
    <header>
        <h1>Добро пожаловать на сайт</h1>
        <nav>
            <ul>
                <li><a href="/journal/home">Главная</a></li>
                <li><a href="/journal/about">О нас</a></li>
                <li><a href="/journal/news">Новости</a></li>
                <li><a href="/journal/contact">Контакты</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <?php include 'views/' . $content_view; ?> <!-- Включение страницы контента -->
    </main>
    
    <footer>
        <p>Все права защищены &copy; 2024</p>
    </footer>
</body>
</html>
