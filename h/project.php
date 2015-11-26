<?php
$bodyprefix = '';
$curprefix = '';
    include('header.php');
?>

    <div class="outer-content-wrapper nopb">
        <div class="content-wrapper">
            <ul class="breadcrumbs">
                <li class="bc-item"><a href="/">Главная</a></li>
                <li class="bc-item"><a href="/projects/">Проекты</a></li>
                <li class="bc-item"><a>Садовая беседка</a></li>
            </ul>
            <h1>Садовая беседка</h1>
            <div class="project-content">
                <aside>
                    <div id="project-slider">
                        <a class="project-image">
                            <img src="/img/img_project1.jpg" alt="project1"/>
                        </a>
                        <a class="project-image">
                            <img src="/img/img_project2.jpg" alt="project1"/>
                        </a>
                        <a class="project-image">
                            <img src="/img/img_project3.jpg" alt="project1"/>
                        </a>
                    </div>
                </aside>
                <div class="project-description">
                    <div class="designer-info">
                        <aside>
                            <div class="img-cnt">
                                <img src="/img/img_designer_avatar.jpg" alt="avatar"/>
                            </div>
                        </aside>
                        <div class="designer-info-inner">
                            <p class="header">Дизайнер</p>
                            <p class="name">Виктория Корнеева</p>
                            <div class="socials-cnt">
                                <a class="designer-social fb" href="#"></a>
                            </div>
                        </div>
                    </div>
                    <div class="designer-about">
                        Сначала это было просто хобби, я интересовалась различными редакторами и программами, пробовала в них работать,
                        делала и исправляла ошибки.
                    </div>
                    <div class="designer-project-about">
                        <p class="header">О проекте</p>
                        <div class="about">
                            В инсталляции использованы дизайнерские подвесные светильники <a href="#">CRYSTAL LIGHT P503-1</a> и предметы декора
                            <a href="#">ARTEVALUCE</a>  — статуэтка «Слон» 73637 и декоративные подсвечники из стекла и металла 88603.
                        </div>
                        <p class="all-projects"><a href="#">Все проекты дизайнера</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="outer-content-wrapper item-cross">
        <div class="content-wrapper">
            <p class="section-header">С этим товаром покупают</p>
            <div class="item-cards-list-cnt">
                <ul class="item-cards-list js-item-cards-slider">
                    <li class="item-card-item">
                        <a href="#">
                            <div class="img-cnt"><img src="/img/img_item1.jpg" alt=""/></div>
                            <div class="item-info">
                                <p class="item-brand">LA MARINA</p>
                                <p class="item-desc">Светильник подвесной</p>
                                <p class="item-price"><span>48 700</span> руб.</p>
                            </div>
                        </a>
                    </li>
                    <li class="item-card-item">
                        <a href="#">
                            <div class="img-cnt"><img src="/img/img_item2.jpg" alt=""/></div>
                            <div class="item-info">
                                <p class="item-brand">ARTEVALUCE</p>
                                <p class="item-desc">Часы</p>
                                <p class="item-price"><span>9 500</span> руб.</p>
                            </div>
                        </a>
                    </li>
                    <li class="item-card-item">
                        <a href="#">
                            <div class="img-cnt"><img src="/img/img_item3.jpg" alt=""/></div>
                            <div class="item-info">
                                <p class="item-brand">EICHHOLTZ</p>
                                <p class="item-desc">Лампа настольная</p>
                                <p class="item-price"><span>25 000</span> руб.</p>
                            </div>
                        </a>
                    </li>
                    <li class="item-card-item">
                        <a href="#">
                            <div class="img-cnt"><img src="/img/img_item4.jpg" alt=""/></div>
                            <div class="item-info">
                                <p class="item-brand">DEVONSHIRE</p>
                                <p class="item-desc">Стул</p>
                                <p class="item-price"><span>25 500</span> руб.</p>
                            </div>
                        </a>
                    </li>
                    <li class="item-card-item">
                        <a href="#">
                            <div class="img-cnt"><img src="/img/img_item1.jpg" alt=""/></div>
                            <div class="item-info">
                                <p class="item-brand">LA MARINA</p>
                                <p class="item-desc">Светильник подвесной</p>
                                <p class="item-price"><span>48 700</span> руб.</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

<?php
    include('footer.php');
?>