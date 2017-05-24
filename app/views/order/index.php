<div class="content">
    <form action="/order" method="POST" class="form">
        <span class="form__title">Офрмление заказа</span>

        <?php if(is_array($errors) && !empty($errors)): ?>
            <ul class="errors">
                <span class="errors__header">Ошибка</span>
                <?php foreach($errors as $error):?>
                    <li class="errors__item"><?=$error?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <label class="form__label">*Имя<br>
            <input type="text" name="name" value="<?=$orderData['name']?>" class="form__input">
        </label class="form__label">
        <label class="form__label">*Телефон<br>
            <input type="text" name="phone" value="<?=$orderData['phone']?>" class="form__input">
        </label>
        <label class="form__label">Email<br>
            <input type="email" name="email" value="<?=$orderData['email']?>" class="form__input">
        </label class="form__label">
        <label class="form__label">Коментрий<br>
            <textarea name="comment" class="form__textarea"><?=$orderData['comment']?></textarea>
        </label>
        <input type="submit" name="submit" value="Отправить" class="form__submit">
    </form>
</div>