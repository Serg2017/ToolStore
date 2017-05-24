<div class="content">
    <div class="content__wrapper">

        <ul class="bread-crumbs g-padding-medium">
            <li class="bread-crumbs__item"><a href="#" class="bread-crumbs__link">Пользователи</a></li>
        </ul>

        <a href="/admin/user/add" class="g-data-add g-margin-medium">Добавить нового пользователя</a>

        <h1 class="g-header g-padding-medium">Все пользователи</h1>
        <table class="table-info g-margin-medium">
            <tr class="table-info__tr">
                <td class="table-info__td table-info__header">Имя пользователя</td>
                <td class="table-info__td table-info__header">Email</td>
                <td class="table-info__td table-info__header">Роль</td>
                <td class="table-info__td table-info__header">Дата/Время регистрации</td>
                <td class="table-info__td table-info__header" colspan="2">Действие</td>
            </tr>

            <?php foreach($users as $user):?>
                <tr class="table-info__tr">
                    <td class="table-info__td"><?=$user['name']?></td>
                    <td class="table-info__td"><?=$user['email']?></td>
                    <td class="table-info__td"><?= \app\models\User::getStringRole($user['role'])?></td>
                    <td class="table-info__td"><?=$user['date']?></td>
                    <td class="table-info__td"><a href="/admin/user/<?=$user['id']?>/update" title="Редактировать" class="g-edit-ico"></a></td>
                    <td class="table-info__td"><a href="/admin/user/<?=$user['id']?>/delete" title="Удалить" class="g-delete-ico"></a></td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>
