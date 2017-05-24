<div class="content">
    <div class="content__wrapper">

        <ul class="bread-crumbs g-padding-medium">
            <li class="bread-crumbs__item"><a href="#" class="bread-crumbs__link">Категории</a></li>
        </ul>

        <a href="/admin/category/add" class="g-data-add g-margin-medium">Добавить новую категорию</a>

        <h1 class="g-header g-padding-medium">Все категории</h1>
        <table class="table-info g-margin-medium">
            <tr class="table-info__tr">
                <td class="table-info__td table-info__header">Название</td>
                <td class="table-info__td table-info__header">Приоритет</td>
                <td class="table-info__td table-info__header">Статус</td>
                <td class="table-info__td table-info__header">Дата/Время добавления</td>
                <td class="table-info__td table-info__header" colspan="2">Действие</td>
            </tr>

            <?php foreach($categories as $category):?>
                <tr class="table-info__tr">
                    <td class="table-info__td"><?=$category['name']?></td>
                    <td class="table-info__td"><?=$category['priority']?></td>
                    <td class="table-info__td"><?=$category['status']?></td>
                    <td class="table-info__td"><?=$category['date']?></td>
                    <td class="table-info__td"><a href="/admin/category/<?=$category['id']?>/update" title="Редактировать" class="g-edit-ico"></a></td>
                    <td class="table-info__td"><a href="/admin/category/<?=$category['id']?>/delete" title="Удалить" class="g-delete-ico"></a></td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>
