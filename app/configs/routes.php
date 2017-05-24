<?php
/**
 * Маршруты
 */
return [

    'category/([0-9]+)' => 'product/category/$1', //actionCategory in ProductController

    'product/view/([0-9]+)' => 'product/view/$1', //actionView in ProductController

    'cart/add/([0-9]+)' => 'cart/add/$1', //actionAdd in CartController
    'cart' => 'cart/index', //actionIndex in CartController

    'order' => 'order/index', //actionIndex in OrderController

    'enter' => 'user/enter', //actionEnter in UserController
    'registration' => 'user/registration', //actionRegistration in UserController
    'logout' => 'user/logout', //actionLogout in UserController
    'user/update' => 'user/update', //actionEdit in UserController

    //Кабинет пользователя
    'cabinet' => 'cabinet/index', //actionIndex in CabinetController
    'cabinet/history' => 'cabinet/history', //actionHistory in CabinetController

    //Пользователи (админка)
    'admin/users' => 'adminUser/index', //actionIndex in AdminUserController
    'admin/user/add' => 'adminUser/add', //actionAdd in AdminUserController
    'admin/user/([0-9]+)/update' => 'adminUser/update/$1', //actionUpdate in AdminUserController
    'admin/user/([0-9]+)/delete' => 'adminUser/delete/$1', //actionDelete in AdminUserController

    //Категории меню (админка)
    'admin/category' => 'adminCategory/index', //actionIndex in AdminCategoryController
    'admin/category/add' => 'adminCategory/add', //actionAdd in AdminCategoryController
    'admin/category/([0-9]+)/update' => 'adminCategory/update/$1', //actionUpdate in AdminCategoryController
    'admin/category/([0-9]+)/delete' => 'adminCategory/delete/$1', //actionDelete in AdminCategoryController


    //Товары (админка)
    'admin/product' => 'adminProduct/index', //actionIndex in AdminProductController
    'admin/product/add' => 'adminProduct/add', //actionAdd in AdminProductController
    'admin/product/([0-9]+)/update' => 'adminProduct/update/$1', //actionUpdate in AdminProductController
    'admin/product/([0-9]+)/delete' => 'adminProduct/delete/$1', //actionDelete in AdminProductController

    //Заказы (админка)
    'admin/orders' => 'adminOrder/index', //actionIndex in AdminOrderController
    'admin/order/([0-9]+)/delete' => 'adminOrder/delete/$1', //actionDelete in AdminOrderDelete


    'admin' => 'admin/index', //actionAdmin in AdminController

    'about' => 'site/about', //actionAbout in SiteController
    'contact' => 'site/contact', //actionContact in SiteController
    'index' => 'site/index', //actionIndex in SiteController
    '' => 'site/index', //actionIndex in SiteController
];