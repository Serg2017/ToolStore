<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?=$title?></title>

    <script src="/public/js/show.js"></script>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
<!-- header -->
<div class="header">

    <div class="header__enter">
        <div class="wrapper">
            <?php if(!app\models\User::isGuest()):?>
                <a href="#" class="title-enter" id="enter">Вход</a>
                <span class="title-all">или</span>
                <a href="#" class="title-registration" id="registration">Регистрация</a>
                <?php else :?>
                    <span class="title-all">Добро пожоловать <a href="/user/update" title="Редактировать" class="title-all"><?=$userName?></a> /</span>
                    <a href="/logout" class="title-all">Выход</a>
                 
            <?php endif; ?>
        </div>
    </div>

    <div class="header__wrapper wrapper">
        <div class="logo"><span class="logo__t">Tools</span><span class="logo__s">Store</span></div>
        <a href="/cart" class="header__cart">
            В корзине: <?=\app\models\Cart::getTotalProductInCart()?>
        </a>

        <!--Header__nav-->
        <div class="header__nav">
            <ul class="nav">
                <li class="nav__item"><a href="/" class="nav__link">Главная</a></li>
                <li class="nav__item"><a href="/cabinet" class="nav__link">Кабинет</a></li>
                <li class="nav__item"><a href="/cabinet/history" class="nav__link">История покупок</a></li>
            </ul>

        </div>


    </div>

</div>
<!-- /header-->

<div class="wrapper">


    <!-- Подключем контент -->
    <?php  include_once $contentView; ?>

</div>


<div style="clear:both"></div>
<div class="footer">
    <div class="footer__wrapper wrapper">
        <div class="footer__content">2017 ToolsStore</div>
    </div>
</div>

<!-- Auth -->
<div class="mask" id="mask_enter">
    <div class="auth">
        <span class="mask__close" id="close_enter"></span>
        <form action="../../../public/index.php" method="POST" class="form" id="auth">
            <span class="form__title">Вход</span>
            <label class="form__label">Email<br>
                <input type="text" name="email" value="" class="form__input">
            </label class="form__label">
            <label class="form__label">Пароль<br>
                <input type="password" name="password" value="" class="form__input">
            </label class="form__label">
            <input type="submit" name="submit" value="Вход" class="form__submit">
        </form>
    </div>
</div>


<!-- Auth -->
<div class="mask" id="mask_reg">
    <div class="registration">
        <span class="mask__close" id="close_reg"></span>
        <form action="../../../public/index.php" method="POST" class="form" id="registartion">
            <span class="form__title">Регистрация</span>
            <label class="form__label">Имя<br>
                <input type="text" name="name" value="">
            </label class="form__label">
            <label class="form__label">Email<br>
                <input type="text" name="email" value="" class="form__input">
            </label class="form__label">
            <label class="form__label">Пароль<br>
                <input type="password" name="password" value="" class="form__input">
            </label class="form__label">
            <label class="form__label">Пароль еще раз<br>
                <input type="password" name="rePassword" value="" class="form__input">
            </label class="form__label">
            <input type="submit" name="submit" value="Регистрация" class="form__submit">
        </form>
    </div>
</div>

</body>
</html>