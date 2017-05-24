<div class="content">
    <div class="content__wrapper">

        <ul class="bread-crumbs g-padding-medium">
            <li class="bread-crumbs__item"><a href="/admin/product" class="bread-crumbs__link">Товары</a></li>
        </ul>

        <a href="/admin/product/add" class="g-data-add g-margin-medium">Добавить новый товар</a>

        <h1 class="g-header g-padding-medium">Все товары</h1>
        <table class="table-info g-margin-medium">
            <tr class="table-info__tr">
                <td class="table-info__td table-info__header">Название товара</td>
                <td class="table-info__td table-info__header">Бренд</td>
                <td class="table-info__td table-info__header">Доступность</td>
                <td class="table-info__td table-info__header">Цена</td>
                <td class="table-info__td table-info__header" >Статус</td>
                <td class="table-info__td table-info__header" >Категория</td>
                <td class="table-info__td table-info__header" colspan="2">Действия</td>
            </tr>

            <?php foreach($products as $product):?>
                <tr class="table-info__tr">
                    <td class="table-info__td"><?=$product['name']?></td>
                    <td class="table-info__td"><?=$product['brand']?></td>
                    <td class="table-info__td"><?=$product['availability']?></td>
                    <td class="table-info__td"><?=$product['price']?></td>
                    <td class="table-info__td"><?=$product['status']?></td>
                    <td class="table-info__td"><?=$product['category_id']?></td>
                    <td class="table-info__td"><a href="/admin/product/<?=$product['id']?>/update" title="Редактировать" class="g-edit-ico"></a></td>
                    <td class="table-info__td"><a href="/admin/product/<?=$product['id']?>/delete" title="Удалить" class="g-delete-ico"></a></td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>
