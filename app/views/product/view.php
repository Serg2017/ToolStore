<div class="content">
    <div class="product-view">
        <div class="product-view__img">
            <img src="/public/images/product/<?=$product['img']?>" alt="bosh">
        </div>
        <div class="product-view__content">
            <h1 class="product-view__title"><?=$product['name'] == null ? 'Нет информации' : $product['name']?></h1>
            <span class="product-view__brand">Бренд: <?=$product['brand'] == null ? 'Нет информации' : $product['brand']?></span>
            <span class="product-view__status">Статус: <?=$product['availability'] == null ? 'Уточните' : $productAvailability?></span>
            <span class="product-view__price">Цена: <?=$product['price'] == null ? 'Уточните' : $product['price']?> грн.</span>
            <a href="/cart/add/<?=$product['id']?>" class="product-view__cart product__cart ">Добавить в корзину</a>
        </div>
        <div class="product-view__description">
            <span class="product-view__title-d">Описание товара</span>
            <p class="product-view__text">
                <?=$product['description'] == null ? 'Нет информации' : $product['description']?>
            </p>
        </div>
    </div>
</div>