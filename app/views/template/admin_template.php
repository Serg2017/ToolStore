<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?=$title?></title>

    <link rel="stylesheet" href="/public/css/admin_style.css">

</head>
<body>

<div class="header">
    <div class="header__logo">Панель управления (ToolStore)</div>

    <div class="header__nav">
        <ul class="nav">
            <li class="nav__item"><a href="/admin" class="nav__link">Главная</a></li>
            <li class="nav__item"><a href="/admin/users" class="nav__link">Пользователи</a></li>
            <li class="nav__item"><a href="/admin/category" class="nav__link">Меню</a></li>
            <li class="nav__item"><a href="/admin/product" class="nav__link">Товары</a></li>
            <li class="nav__item"><a href="/admin/orders" class="nav__link">Заказы</a></li>
        </ul>

        <ul class="nav additional-nav">
            <li class="nav__item"><span href="" class="nav__link">Привет Admin(admin)</span></li>
            <li class="nav__item"><a href="/" class="nav__link">Перейти на сайт</a></li>
            <li class="nav__item"><a href="/logout" class="nav__link">Выход</a></li>
        </ul>
    </div>
</div>

<!-- Content -->
<?php include_once $contentView; ?>

<div class="footer">
    <span class="footer__text">2017 footer</span>
</div>

</body>
</html>