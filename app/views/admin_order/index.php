<div class="content">
    <div class="content__wrapper">

        <ul class="bread-crumbs g-padding-medium">
            <li class="bread-crumbs__item"><a href="/admin/order" class="bread-crumbs__link">Заказы</a></li>
        </ul>

        <span class="order_new"></span><span class="order_explanation"> - Новый заказ</span><br>
        <span class="order_treatment"></span><span class="order_explanation"> - Заказ находится в обработке</span><br>
        <span class="order_delivered"></span><span class="order_explanation"> - Заказ доставляется </span><br>
        <span class="order_fulfilled"></span><span class="order_explanation"> - Заказ выполнен </span><br>

        <h1 class="g-header g-padding-medium">Все заказы</h1>
        <table class="table-info g-margin-medium">
            <tr class="table-info__tr">
                <td class="table-info__td table-info__header">Имя</td>
                <td class="table-info__td table-info__header">Телефон</td>
                <td class="table-info__td table-info__header">Email</td>
                <td class="table-info__td table-info__header">Товары</td>
                <td class="table-info__td table-info__header" >Комментрий</td>
                <td class="table-info__td table-info__header" >Пользователь</td>
                <td class="table-info__td table-info__header" >Дата</td>
                <td class="table-info__td table-info__header">Удалить</td>
            </tr>

            <?php foreach($orders as $order):?>
                <tr class="table-info__tr">
                    <td class="table-info__td"><?=$order['name']?></td>
                    <td class="table-info__td"><?=$order['phone']?></td>
                    <td class="table-info__td"><?=$order['email']?></td>
                    <td class="table-info__td"><?=$order['products']?></td>
                    <td class="table-info__td"><?=$order['comment']?></td>
                    <td class="table-info__td"><?=$order['user_id']?></td>
                    <td class="table-info__td"><?=$order['date']?></td>
                    <td class="table-info__td"><a href="/admin/order/<?=$order['id']?>/delete" title="Удалить" class="g-delete-ico"></a></td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>
