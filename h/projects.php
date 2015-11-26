<?php
$bodyprefix = '';
$curprefix = '';
    include('header.php');
?>

<div class="outer-content-wrapper nopb">
    <div class="content-wrapper">
        <ul class="breadcrumbs">
            <li class="bc-item"><a href="/">Главная</a></li>
            <li class="bc-item"><a>Проекты</a></li>
        </ul>
        <h1>Проекты</h1>
        <ul class="designer-projects-list">
            <li class="designer-project-item">
                <a href="#">
                    <img src="/img/img_project1.jpg" alt="project1"/>
                    <div class="caption">
                        <p class="heading">Садовая беседка</p>
                        <div class="designer">Дизайнер <p>Виктория Корнеева</p></div>
                    </div>
                </a>
            </li>
            <li class="designer-project-item">
                <a href="#">
                    <img src="/img/img_project2.jpg" alt="project2"/>
                    <div class="caption">
                        <p class="heading">Часики</p>
                        <div class="designer">Дизайнер <p>Виктория Корнеева</p></div>
                    </div>
                </a>
            </li>
            <li class="designer-project-item">
                <a href="#">
                    <img src="/img/img_project3.jpg" alt="project3"/>
                    <div class="caption">
                        <p class="heading">Проект гостиной</p>
                        <div class="designer">Дизайнер <p>Виктория Корнеева</p></div>
                    </div>
                </a>
            </li>
            <li class="designer-project-item">
                <a href="#">
                    <img src="/img/img_project4.jpg" alt="project4"/>
                    <div class="caption">
                        <p class="heading">Проект трехкомнатной квартиры</p>
                        <div class="designer">Дизайнер <p>Виктория Корнеева</p></div>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>

<?php
    include('footer.php');
?>