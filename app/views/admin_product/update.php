<div class="content">
    <div class="content__wrapper">

        <ul class="bread-crumbs g-padding-medium">
            <li class="bread-crumbs__item"><a href="/admin/product" class="bread-crumbs__link">Товары</a></li>
            <li class="bread-crumbs__item"><a href="/admin/product/add" class="bread-crumbs__link">Редактировать товар</a></li>
        </ul>

        <h1 class="g-header g-padding-medium">Редактировать товар</h1>

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
                <input type="text" name="title" value="<?=$product['title']?>" class="form__input">
            </label>
            <label class="form__label">*Description<br>
                <input type="text" name="meta_d" value="<?=$product['meta_d']?>" class="form__input">
            </label>
            <label class="form__label">*Keywords<br>
                <input type="text" name="meta_k" value="<?=$product['meta_k']?>" class="form__input">
            </label>

            <label class="form__label">*Изображение<br>
                <input type="file" name="img" value="" class="form__file">
            </label>

            <label class="form__label">*Название товара<br>
                <input type="text" name="name" value="<?=$product['name']?>" class="form__input">
            </label>
            <label class="form__label">Бренд<br>
                <input type="text" name="brand" value="<?=$product['brand']?>" class="form__input">
            </label>
            <label class="form__label">Доступность<br>
                <input type="text" name="availability" value="<?=$product['availability']?>" class="form__input">
            </label>
            <label class="form__label">Цена<br>
                <input type="text" name="price" value="<?=$product['price']?>" class="form__input">
            </label>
            <label class="form__label">Описание<br>
                <textarea name="description" class="form__textarea"><?=$product['description']?></textarea>
            </label>

            <label class="form__label">Приоритет<br>
                <input type="text" name="priority" value="<?=$product['priority']?>" class="form__input">
            </label>

            <label class="form__label">*Статус<br>
                <select name="status" class="form__select">
                    <option value="1" <?php if ($product['status'] == 1) echo ' selected="selected"'; ?>>Отображать</option>
                    <option value="0" <?php if ($product['status'] == 0) echo ' selected="selected"'; ?>>Не отображать</option>
                </select>
            </label>

            <label class="form__label">*Категория<br>
                <select name="category_id" class="form__select">
                    <?php foreach($categories as $category):?>
                        <option value="<?=$category['id']?>" <?php if ($product['category_id'] == $category['id']) echo ' selected="selected"'; ?>><?=$category['name']?></option>
                    <?php endforeach; ?>
                </select>
            </label>

            <input type="submit" name="submit" value="Обновить" class="form__submit">
        </form>

    </div>
</div>