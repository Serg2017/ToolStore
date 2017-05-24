<div class="content">
    <div class="content__wrapper">

        <ul class="bread-crumbs g-padding-medium">
            <li class="bread-crumbs__item"><a href="/admin/category" class="bread-crumbs__link">Категории</a></li>
            <li class="bread-crumbs__item"><a href="/admin/category/add" class="bread-crumbs__link">Редактировать категорию</a></li>
        </ul>

        <h1 class="g-header g-padding-medium">Редактировать категорию</h1>

        <?php if(is_array($errors) && !empty($errors)): ?>
            <ul class="errors">
                <span class="errors__header">Ошибка</span>
                <?php foreach($errors as $error):?>
                    <li class="errors__item"><?=$error?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form action="" method="POST" class="form g-margin-medium">
            <label class="form__label">*Title<br>
                <input type="text" name="title" value="<?=$category['title']?>" class="form__input">
            </label>
            <label class="form__label">*Description<br>
                <input type="text" name="meta_d" value="<?=$category['meta_d']?>" class="form__input">
            </label>
            <label class="form__label">*Keywords<br>
                <input type="text" name="meta_k" value="<?=$category['meta_k']?>" class="form__input">
            </label>
            <label class="form__label">*Название категории<br>
                <input type="text" name="name" value="<?=$category['name']?>" class="form__input">
            </label>
            <label class="form__label">Приоритет<br>
                <input type="text" name="priority" value="<?=$category['priority']?>" class="form__input">
            </label>

            <label class="form__label">*Статус<br>
                <select name="status" class="form__select">
                    <option value="1" <?php if ($category['status'] == 1) echo ' selected="selected"'; ?>>Отображать</option>
                    <option value="0" <?php if ($category['status'] == 0) echo ' selected="selected"'; ?>>Не отображать</option>
                </select>
            </label>
            <input type="submit" name="submit" value="Обновить" class="form__submit">
        </form>

    </div>
</div>