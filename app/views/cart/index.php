<div class="content">
    <span class="cart-header">Корзина товаров</span>
    <table class="cart">
        <tr class="cart__tr">
            <td class="cart__title cart__td">Название товара</td>
            <td class="cart__title cart__td">Количество</td>
            <td class="cart__title cart__td">Стоимость за 1</td>
            <td class="cart__title cart__td">Общая стоимость</td>
        </tr>
        <?php foreach($productsByIds as $product): ?>
            <tr class="cart__tr <?=$product['price'] == null ? 'incorrect_tr' : ''?>" >
                <td class="cart__td">
                    <a href="/product/view/<?=$product['id']?>">
                        <?=$product['name'] == null ? 'Нет информации' : $product['name']  ?>
                    </a>
                </td>
                <td class="cart__td"><?=$productsInCart[$product['id']]?></td>
                <td class="cart__td"><?=$product['price'] == null ? 'Нет информации' : $product['price']?></td>
                <td class="cart__td"><?=$productsInCart[$product['id']] * $product['price']?></td>
                <?php $totalPrice += $productsInCart[$product['id']] * $product['price']?>
            </tr>
        <?php endforeach; ?>
        <tr class="cart__tr">
            <td colspan="4" class="cart__td">Всего товаров в корзине: <?=$totalProductInCart?> </td>
        </tr>
        <tr class="cart__tr">
            <td colspan="4" class="cart__td">Стоимость всех товаров: <?=$totalPrice?> грн. </td>
        </tr>
    </table>
    <a href="/order" class="button-order">Оформить заказ</a>
</div>