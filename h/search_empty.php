<?php
$bodyprefix = '';
$curprefix = '';
include('header.php');
?>

    <div class="empty-search-wrapper">
        <div class="content-wrapper">
            <h1>Результаты поиска</h1>
            <div class="search-tools-cnt empty">
                <div class="search-input-cnt">
                    <div class="search-form-cnt">
                        <form action="">
                            <input type="text" name="sp-search" id="sp-search" class="search-input"/><input type="submit" class="search-submit" value=""/>
                        </form>
                    </div>
                    <div class="search-categories">
                        <div class="links">
                            <a href="#">Все</a><a href="#" class="active">Артикул</a>
                        </div>
                    </div>
                    <p class="search-results">
                        По вашему запросу <br/> <em>Настольная лампа</em> найдено страниц <em>0</em>
                    </p>
                    <p class="search-meta">попробуйте поиск по другому параметру</p>
                </div>
            </div>
        </div>
    </div>


<?php
include('footer.php');
?>