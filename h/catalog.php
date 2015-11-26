<?php
$bodyprefix = '';
$curprefix = '';
    include('header.php');
?>

<div class="outer-content-wrapper">
    <div class="content-wrapper">
        <ul class="breadcrumbs">
            <li class="bc-item"><a href="/">Главная</a></li>
            <li class="bc-item"><a href="/">Светильники</a></li>
            <li class="bc-item"><a>Люстры</a></li>
        </ul>
        <h1>Люстры</h1>
        <div class="categories-list-cnt tabs-cnt">
            <ul class="tabs-list acenter">
                <li class="active">
                    <a class="active" href="#">Все</a>
                </li>
                <li>
                    <a href="#">Подвесные</a>
                </li>
                <li>
                    <a href="#">Потолочные</a>
                </li>
                <li>
                    <a href="#">Настенные</a>
                </li>
            </ul>
        </div>
        <div class="catalog-filter">
            <form class="common-form inverse" action="">
                <div class="catalog-filter-top">
                    <div class="price-slider-cnt">
                        <div class="price-slider" data-min="3000" data-max="150000"></div>
                        <input type="hidden" name="price-min" id="price-min"/>
                        <input type="hidden" name="price-max" id="price-max"/>
                        <div class="price-cnt min">
                            <input class="price-min" type="text"/>
                            <span>a</span>
                        </div>
                        <div class="price-cnt max">
                            <input class="price-max" type="text"/>
                            <span>a</span>
                        </div>
                    </div>
                    <div class="presence-cb-cnt">
                        <input class="css-checkbox js-filter-presence" type="checkbox" name="filter-presence" id="filter-presence"/><label class="cb-label" for="filter-presence">В наличии</label>
                    </div>
                    <div class="sort-cnt">
                        <a class="js-sort sort-none" data-state="none" data-field="sortPopular" href="#">По популярности</a>
                    </div>
                    <div class="sort-cnt">
                        <a class="js-sort sort-none" data-state="none" data-field="sortPrice" href="#">По цене</a>
                    </div>
                    <div class="more-params-cnt">
                        <a class="js-filter-more-params" href="#">
                            <span>Еще параметры</span>
                            <span>Свернуть</span>
                        </a>
                    </div>
                </div>
                <div class="catalog-filter-bottom">
                    <div class="row">
                        <div class="col13">
                            <fieldset>
                                <label for="filter-brand">Бренд</label>
                                <select data-name="filter-brand" name="filter-brand" id="filter-brand" multiple data-placeholder="Выберите бренд" class="js-multiple-select">
                                    <option value="" class="mobile-hide"></option>
                                    <option value="1">EICHHOLTZ</option>
                                    <option value="2">CRYSTAL LIGHT</option>
                                    <option value="3">ARTEVALUCE</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col13">
                            <fieldset>
                                <label for="filter-style">Стиль</label>
                                <select data-name="filter-style" name="filter-style" id="filter-style" multiple data-placeholder="Выберите стиль" class="js-multiple-select">
                                    <option value="" class="mobile-hide"></option>
                                    <option value="1">Классические</option>
                                    <option value="2">Дизайнерские</option>
                                    <option value="3">Модерн</option>
                                    <option value="4">Хрустальные</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col13">
                            <fieldset>
                                <label for="filter-material">Материал</label>
                                <select data-name="filter-material" name="filter-material" id="filter-material" multiple data-placeholder="Выберите материал" class="js-multiple-select">
                                    <option value="" class="mobile-hide"></option>
                                    <option value="1">ткань</option>
                                    <option value="2">хрусталь</option>
                                    <option value="3">пенька</option>
                                    <option value="4">стекло</option>
                                    <option value="5">пластик</option>
                                    <option value="6">металл</option>
                                    <option value="7">полиэстер</option>
                                    <option value="8">металл + текстиль</option>
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col13">
                            <fieldset>
                                <label for="filter-install-type">Тип установки</label>
                                <select data-name="filter-install-type" name="filter-install-type" id="filter-install-type" multiple data-placeholder="Выберите тип установки" class="js-multiple-select">
                                    <option value="" class="mobile-hide"></option>
                                    <option value="1">потолочные</option>
                                    <option value="2">подвесные</option>
                                    <option value="3">накладные</option>
                                    <option value="4">настенные</option>
                                    <option value="5">прикроватные</option>
                                    <option value="6">настольные</option>
                                    <option value="7">напольные</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col13">
                            <fieldset>
                                <label for="filter-replica">Реплика</label>
                                <select data-name="filter-replica" name="filter-replica" id="filter-replica" multiple data-placeholder="Выберите значение" class="js-multiple-select">
                                    <option value="" class="mobile-hide"></option>
                                    <option value="1">Artemide</option>
                                    <option value="2">Moooi</option>
                                    <option value="3">Flos</option>
                                    <option value="4">Vistosi</option>
                                    <option value="5">Tom Dixon</option>
                                    <option value="6">Foscarini</option>
                                    <option value="7">Ipe Cavalli</option>
                                    <option value="8">Brand Van Egmond</option>
                                    <option value="9">Louis Poulsen</option>
                                    <option value="10">Metalarte Josephine</option>
                                    <option value="11">Terzani с цепочками</option>
                                </select>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="item-cards-list-cnt">
            <ul class="item-cards-list matrix">
                <li class="item-card-item">
                    <a href="#">
                        <div class="img-cnt"><img src="/img/img_item1.jpg" alt=""/></div>
                        <div class="item-info">
                            <p class="item-brand">Артикул C141-1</p>

                            <p class="item-desc">Светильник подвесной</p>

                            <p class="item-price"><span>48 700</span> руб.</p>
                        </div>
                        <div class="item-card-badge hit">Хит продаж</div>
                    </a>
                </li>
                <li class="item-card-item">
                    <a href="#">
                        <div class="img-cnt"><img src="/img/img_item2.jpg" alt=""/></div>
                        <div class="item-info">
                            <p class="item-brand">Артикул C141-1</p>

                            <p class="item-desc">Часы</p>

                            <p class="item-price"><span>9 500</span> руб.</p>
                        </div>
                    </a>
                </li>
                <li class="item-card-item">
                    <a href="#">
                        <div class="img-cnt"><img src="/img/img_item3.jpg" alt=""/></div>
                        <div class="item-info">
                            <p class="item-brand">Артикул C141-1</p>

                            <p class="item-desc">Лампа настольная</p>

                            <p class="item-price"><span>25 000</span> руб.</p>
                        </div>
                    </a>
                </li>
                <li class="item-card-item">
                    <a href="#">
                        <div class="img-cnt"><img src="/img/img_item4.jpg" alt=""/></div>
                        <div class="item-info">
                            <p class="item-brand">Артикул C141-1</p>

                            <p class="item-desc">Стул</p>

                            <p class="item-price"><span>25 500</span> руб.</p>
                        </div>
                    </a>
                </li>
                <li class="item-card-item">
                    <a href="#">
                        <div class="img-cnt"><img src="/img/img_item1.jpg" alt=""/></div>
                        <div class="item-info">
                            <p class="item-brand">Артикул C141-1</p>

                            <p class="item-desc">Светильник подвесной</p>

                            <p class="item-price"><span>48 700</span> руб.</p>
                        </div>
                    </a>
                </li>
            </ul>
            <div class="preload-overlay"><i></i></div>
       </div>
        <div class="catalog-tags-cnt">
            <ul class="catalog-tag-list">
                <li class="catalog-tag"><a href="#">настольные</a></li>
                <li class="catalog-tag"><a href="#">настенные</a></li>
                <li class="catalog-tag"><a href="#">для кухни</a></li>
                <li class="catalog-tag"><a href="#">для спальни</a></li>
                <li class="catalog-tag"><a href="#">для гостиной</a></li>
                <li class="catalog-tag"><a href="#">для зала</a></li>
                <li class="catalog-tag"><a href="#">для прихожей</a></li>
                <li class="catalog-tag"><a href="#">шар</a></li>
                <li class="catalog-tag"><a href="#">большие</a></li>
                <li class="catalog-tag"><a href="#">черные</a></li>
                <li class="catalog-tag"><a href="#">белые</a></li>
                <li class="catalog-tag"><a href="#">дизайнерские</a></li>
                <li class="catalog-tag"><a href="#">металлические</a></li>
                <li class="catalog-tag"><a href="#">текстильные</a></li>
                <li class="catalog-tag"><a href="#">Crystal light</a></li>
            </ul>
        </div>
        <ul class="pagination">
            <li class="pagination-item"><a href="#">1</a></li>
            <li class="pagination-item"><a href="#">2</a></li>
            <li class="pagination-item"><a>3</a></li>
            <li class="pagination-item"><a href="#">4</a></li>
            <li class="pagination-item"><a href="#">5</a></li>
            <li class="pagination-item"><a href="#">6</a></li>
        </ul>

    </div>
</div>


<?php
    include('footer.php');
?>