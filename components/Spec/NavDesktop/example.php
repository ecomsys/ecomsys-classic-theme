<!-- ================= NAVIGATION ================= -->
<nav class="header__nav nav">
    <ul class="nav__list">
        <!-- Каталог с выпадающим меню -->
        <li class="nav__item nav__item--has-dropdown">
            <a href="catalog.html">
                <span>Каталог</span>
                <?php svg_icon('caret', 'w-4 h-4 icon--header-caret nav__caret'); ?>
            </a>

            <!-- Dropdown -->
            <ul class="nav__dropdown scrollbar-none">
                <!-- iPhone -->
                <li class="nav__item nav__item--has-children">
                    <a href="#">
                        <span>Apple iPhone</span>
                        <?php svg_icon('right-chevron', 'w-4 h-4 icon--canvas-caret-right'); ?>
                    </a>

                    <ul class="nav__sub-dropdown scrollbar-none">
                        <li class="nav__item"><a href="#">iPhone 17 Pro Max</a></li>
                        <li class="nav__item"><a href="#">iPhone 17 Pro</a></li>
                        <li class="nav__item"><a href="#">iPhone 17</a></li>
                        <li class="nav__item"><a href="#">iPhone 17 Air</a></li>
                        <li class="nav__item"><a href="#">iPhone 16 Pro Max</a></li>
                        <li class="nav__item"><a href="#">iPhone 16 Pro</a></li>
                        <li class="nav__item"><a href="#">iPhone 16</a></li>
                        <li class="nav__item"><a href="#">iPhone 16 Plus</a></li>
                        <li class="nav__item"><a href="#">iPhone 16 E</a></li>
                    </ul>
                </li>

                <!-- MacBook -->
                <li class="nav__item nav__item--has-children">
                    <a href="#">
                        <span>Apple MacBook</span>
                        <?php svg_icon('right-chevron', 'w-4 h-4 icon--canvas-caret-right'); ?>
                    </a>

                    <ul class="nav__sub-dropdown scrollbar-none">
                        <li><a href="#">MacBook Air</a></li>
                        <li><a href="#">MacBook Pro</a></li>
                    </ul>
                </li>

                <!-- Остальные пункты -->
                <li><a href="#">Apple AirPods</a></li>
                <li><a href="#">Apple Watch</a></li>
                <li><a href="#">Apple iPad</a></li>
                <li><a href="#">Аксессуары</a></li>
            </ul>
        </li>

        <!-- Простые пункты меню -->
        <li class="nav__item"><a href="#">Доставка и оплата</a></li>
        <li class="nav__item"><a href="#">Гарантия</a></li>
        <li class="nav__item"><a href="#">Trade-in</a></li>
        <li class="nav__item"><a href="#">О компании</a></li>
        <li class="nav__item"><a href="#">Контакты</a></li>
    </ul>
</nav>