<!-- ================= OFFCANVAS MOBILE MENU ================= -->
<div class="offcanvas" id="mobileMenu">
    <div class="offcanvas__inner">
        <!-- Закрытие -->
        <button class="offcanvas__close">
            <?php svg_icon('close', 'w-4 h-4 icon icon--canvas-close'); ?>
        </button>

        <!-- Меню -->
        <div class="offcanvas__overflow scrollbar-none">
            <ul class="offcanvas__menu">
                <!-- Каталог -->
                <li class="offcanvas__item offcanvas__item--has-children">
                    <div class="offcanvas__link">
                        <a href="#">Каталог</a>
                        <?php svg_icon('caret', 'w-4 h-4 offcanvas__caret'); ?>

                    </div>

                    <ul class="offcanvas__sub">
                        <li><a href="#">Apple iPhone</a></li>
                        <li><a href="#">Apple MacBook</a></li>
                        <li><a href="#">Apple AirPods</a></li>
                        <li><a href="#">Apple Watch</a></li>
                        <li><a href="#">Apple iPad</a></li>
                        <li><a href="#">Аксессуары</a></li>
                    </ul>
                </li>

                <!-- Остальные пункты -->
                <li class="offcanvas__item"><a href="#">Доставка и оплата</a></li>
                <li class="offcanvas__item"><a href="#">Гарантия</a></li>
                <li class="offcanvas__item"><a href="#">Trade-in</a></li>
                <li class="offcanvas__item"><a href="#">О компании</a></li>
            </ul>
        </div>
    </div>
</div>