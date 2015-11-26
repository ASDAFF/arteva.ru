<?php
$bodyprefix = '';
$curprefix = '';
include('header.php');
?>

    <div class="outer-content-wrapper">
        <div class="content-wrapper">
            <h1>Результаты поиска</h1>
            <div class="search-tools-cnt">
                <div class="search-input-cnt">
                    <div class="search-form-cnt">
                        <form action="">
                            <input type="text" name="sp-search" id="sp-search" class="search-input"/><input type="submit" class="search-submit" value=""/>
                            <p class="search-results">
                                По вашему запросу <em>Настольная лампа</em> найдено страниц <em>0</em>
                            </p>
                        </form>
                    </div>
                    <div class="search-categories">
                        <div class="links">
                            <a href="#">Все</a><a href="#" class="active">Артикул</a>
                        </div>
                    </div>
                </div>
                <div class="results-count-cnt">
                    <div class="results-count">
                        <select class="js-common-select-nosearch" name="results-count" id="results-count">
                            <option value="5">4</option>
                            <option value="5">12</option>
                            <option value="5">20</option>
                        </select>
                    </div>
                    <p class="results-count-text">Результатов <br/> на странице</p>
                </div>
            </div>
            <div class="item-cards-list-cnt">
                <ul class="item-cards-list matrix">
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