<div class="content cabinet-content">
    <span class="cart-header">История покупок</span>

    <?php if(count($ordersById) > 0):?>
        <table class="cart">
            <tr class="cart__tr">
                <td class="cart__title cart__td">Название товара</td>
                <td class="cart__title cart__td">Количество</td>
                <td class="cart__title cart__td">Стоимость за 1 на данный момент</td>
            </tr>
            <?php foreach($ordersById as $order): ?>
                <tr>
                    <td class="cart__td" colspan="3">
                        Дата заказа: <?=$order['date']?>
                    </td>
                </tr>
                <?php foreach(json_decode($order['products'], true) as $productId => $count):?>
                <tr class="cart__tr" >
                    <td class="cart__td">
                        <a href="/product/view/<?=$productId?>">
                            <?=app\models\Product::getProductById($productId)['name']?>
                        </a>
                    </td>
                    <td class="cart__td">
                        <?=$count?>
                    </td>
                    <td class="cart__td">
                        <?=app\models\Product::getProductById($productId)['price']?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </table>
        <?php else:?>
            <p class="g-text">Вы не совершили не одной покупки</p>
    <?php endif;?>

</div>