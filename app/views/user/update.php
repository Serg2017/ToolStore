<div class="content cabinet-content">
    <form action="" method="POST" class="form">
        <span class="form__title">Редактирование данных пользователя</span>

        <?php if(is_array($errors) && !empty($errors)): ?>
            <ul class="errors">
                <span class="errors__header">Ошибка</span>
                <?php foreach($errors as $error):?>
                    <li class="errors__item"><?=$error?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <label class="form__label">Имя<br>
            <input type="text" name="name" value="<?=$userInfo['name']?>" class="form__input">
        </label class="form__label">
        <label class="form__label">Email<br>
            <input type="text" name="email" value="<?=$userInfo['email'] ?>" class="form__input">
        </label class="form__label">
        <label class="form__label">Пароль<br>
            <input type="password" name="password" value="" class="form__input">
        </label class="form__label">
        <label class="form__label">Пароль еще раз<br>
            <input type="password" name="rePassword" value="" class="form__input">
        </label class="form__label">
        <input type="submit" name="submit" value="Изменить" class="form__submit">
    </form>
</div>