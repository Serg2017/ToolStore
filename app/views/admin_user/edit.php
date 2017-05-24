<div class="content">
    <div class="content__wrapper">

        <ul class="bread-crumbs g-padding-medium">
            <li class="bread-crumbs__item"><a href="/admin/users" class="bread-crumbs__link">Пользователи</a></li>
            <li class="bread-crumbs__item"><a href="/admin/users/add" class="bread-crumbs__link">Редактировать пользователя</a></li>
        </ul>

        <h1 class="g-header g-padding-medium">Редактировать пользователя</h1>

        <?php if(is_array($errors) && !empty($errors)): ?>
            <ul class="errors">
                <span class="errors__header">Ошибка</span>
                <?php foreach($errors as $error):?>
                    <li class="errors__item"><?=$error?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form action="" method="POST" class="form g-margin-medium">
            <label class="form__label">Имя<br>
                <input type="text" name="name" value="<?=$user['name']?>" class="form__input">
            </label>
            <label class="form__label">Email<br>
                <input type="text" name="email" value="<?=$user['email']?>" class="form__input">
            </label>
            <label class="form__label">Пароль<br>
                <input type="password" name="password" value="" class="form__input">
            </label>
            <label class="form__label">Пароль еще раз<br>
                <input type="password" name="rePassword" value="" class="form__input">
            </label>
            <label class="form__label">Роль<br>
                <select name="role" class="form__select">
                    <option value="0" <?php if ($user['role'] == 0) echo ' selected="selected"'; ?>>Пользователь</option>
                    <option value="1" <?php if ($user['role'] == 1) echo ' selected="selected"'; ?>>Менеджер</option>
                    <option value="2" <?php if ($user['role'] == 2) echo ' selected="selected"'; ?>>Администратор</option>
                    <option value="3" <?php if ($user['role'] == 3) echo ' selected="selected"'; ?>>Главный администратор</option>
                </select>
            </label>
            <input type="submit" name="submit" value="Изменить" class="form__submit">
        </form>

    </div>
</div>