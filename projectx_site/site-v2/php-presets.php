<!--Код на многомерный ассоциативный массив и скрипты для динамического перехода по разным страницам-->

<?php
       $goods = [
            [
                "id" => 1,
                "name" => "Nezuko",
                "desc" => "Свежая вайфу 2019 года",
                "img" => "https://wallpaperaccess.com/full/1105100.jpg",
                "img2" => "https://wallpaperaccess.com/full/1105088.jpg",
                "img3" => "https://wallpaperaccess.com/full/1105113.jpg",
                "img4" => "https://wallpaperaccess.com/full/1105109.png",
                "img5" => "https://pbs.twimg.com/media/EGsAIVrWkAAiDGO.jpg",
                "price" => "2000 $"             
            ],
            [
                "id" => 2,
                "name" => "Raphtalia",
                "desc" => "Если вы фапаете на енота из стражей галактики, то теперь у вас будет шанс выебать его.",
                "img" => "https://cs11.pikabu.ru/post_img/big/2019/02/11/7/1549880438131745410.png",
                "img2" => "https://i.kym-cdn.com/photos/images/original/001/450/049/370.jpg",
                "img3" => "/img/goods/Raphtalia2.jpg",
                "img4" => "https://i.pinimg.com/originals/f5/87/19/f58719ca355c6420aa0c646c31fecdf6.jpg",
                "img5" => "/img/goods/Raphtalia.jpg",
                "price" => "2500 $"
            ],
            [
                "id" => 3,
                "name" => "Shinobu",
                "desc" => "Абсолютно легальная лоля",
                "img" => "https://c.wallhere.com/photos/d7/01/anime_anime_girls_white_skin_loli_blond_hair_blonde_Oshino_Shinobu_yellow_eyes-1513417.jpg!d",
                "img2" => "https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/69dfb87f-f303-4c66-89c4-d94eda4a6510/d6k5a4w-b6181633-0fab-4e25-bbff-fc8b16e013f0.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzY5ZGZiODdmLWYzMDMtNGM2Ni04OWM0LWQ5NGVkYTRhNjUxMFwvZDZrNWE0dy1iNjE4MTYzMy0wZmFiLTRlMjUtYmJmZi1mYzhiMTZlMDEzZjAucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.azyFy7ZOXnrVgkIXKo6RnWpQKgPi0upHMNw4GMSZ0yE",
                "img3" => "https://animesolution.com/wp-content/uploads/2019/04/Kizumonogatari-01_00.39.39_2019.04.02_02.25.47_stitch.jpg",
                "img4" => "https://www.anzhuo52.com/wp-content/uploads/2017/12/131584168655027458.jpg",
                "img5" => "https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/6378fe58-25db-4f6e-9a6f-53de443b25fc/dcq6q9y-f4b50717-f0e2-42d7-ba6b-368c5c931a82.png/v1/fill/w_1024,h_854,strp/__r_002___oshino_shinobu_by_shoux_baka_dcq6q9y-fullview.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9ODU0IiwicGF0aCI6IlwvZlwvNjM3OGZlNTgtMjVkYi00ZjZlLTlhNmYtNTNkZTQ0M2IyNWZjXC9kY3E2cTl5LWY0YjUwNzE3LWYwZTItNDJkNy1iYTZiLTM2OGM1YzkzMWE4Mi5wbmciLCJ3aWR0aCI6Ijw9MTAyNCJ9XV0sImF1ZCI6WyJ1cm46c2VydmljZTppbWFnZS5vcGVyYXRpb25zIl19.XgLDhMOA17SSxfBXsLUBzr-pULru7faeZ57uFEA_lNY",
                "price" => "3000 $"
            ],
            [
                "id" => 4,
                "name" => "Zero Two",
                "desc" => "Выебать динозавра? Не вопрос!",
                "img" => "https://i.pinimg.com/originals/c6/9e/ed/c69eedb115f039544f873b2b0cf4b44a.jpg",
                "img2" => "https://data.whicdn.com/images/312395476/original.jpg",
                "img3" => "https://cdn130.picsart.com/289410828010201.jpg",
                "img4" => "https://wallpaperaccess.com/full/1106800.jpg",
                "img5" => "https://wallpaperaccess.com/full/1106808.jpg",
                "price" => "1000 $"
            ],
            [
                "id" => 5,
                "name" => "Speedwagon",
                "desc" => "Лучшая вайфу эвер",
                "img" => "https://cs7.pikabu.ru/post_img/2019/05/10/11/1557513851117492276.jpg",
                "img2" => "https://i.ytimg.com/vi/n-aZBwOj94w/maxresdefault.jpg",
                "img3" => "https://art.pixilart.com/e4cb1e4e28be48f.png",
                "img4" => "https://i.redd.it/kbqvku62mtd31.jpg",
                "img5" => "http://www.lumiere-mag.ru/wp-content/uploads/2016/12/a_clockwork_orange_cover.jpg",
                "price" => "10000 $"
            ],
            [
                "id" => 6,
                "name" => "Emilia",
                "desc" => "Если ты субару, то сможешь наконец выйти из френд зоны.",
                "img" => "/img/goods/emilia.jpg",
                "price" => "100 $"
            ],
            [
                "id" => 7,
                "name" => "Megumin",
                "desc" => "Горяча как ядерная бомба. В постельке как бревно. Нелегальна во многих странах.",
                "img" => "/img/goods/megumin.jpg",
                "price" => "5000 $"
            ],
            [
                "id" => 8,
                "name" => "Kaguya-sama",
                "desc" => "Для истинных ценителей словесной порки",
                "img" => "/img/goods/kaguya-sama.jpg",
                "price" => "3000 $"
            ],
            [
                "id" => 9,
                "name" => "Sagiri",
                "desc" => "Мусор",
                "img" => "/img/goods/eromanga.jpg",
                "price" => "БЕСПЛАТНО"
            ]
       ];

       $page = $_GET["page"];
       if (!isset($page)) {
            require('templates/main.php');
       } elseif ($page == "shop") {
            require('templates/shop.php');
       } elseif ($page == "product") {
            $id = $_GET['id'];
            $good = [];
            foreach ($goods as $product) {
                if ($product['id'] == $id) {
                    $good = $product;
                    break;
                }
            }
            require('templates/openProduct.php');
       }
    ?> 

<!--Собственно тут дальше идет сама реализация динамической смены элементов, в зависимости от входных данных. В данном случае тут реализована смена шапки в зависимости от значения переменно $page, работает в синергии с верхним скриптом. Так где можно обойтись без php, лучше все писать на js и html/css, ведь это все можно предварительно загрузить в кеш браузера и сайт будет работать очень быстро и плавно. php важен для отправления на обмена с сервером действительно важной и конфидициальной инфой.-->

<?php $page = $_GET["page"];
       if (!isset($page)) {
            echo '<div id="headermain">
                    <div id="headerInside">
                        <div id="logo"></div>
                        <div id="companyName">Lolishop</div>
                        <div id="navWrap">
                            <a href="/">Главная</a>
                            <a href="index.php?page=shop">Магазин</a>
                        </div>
                    </div> 
                </div>';
       } elseif ($page == "shop") {
            echo '<div id="headershop">
                    <div id="headerInside">
                        <div id="logo"></div>
                        <div id="companyName">Lolishop</div>
                        <div id="navWrap">
                            <a href="/">Главная</a>
                            <a href="index.php?page=shop">Магазин</a>
                        </div>
                    </div> 
                </div>';

       } elseif ($page == "product") {
           echo '<div id="headershop">
                    <div id="headerInside">
                        <div id="logo"></div>
                        <div id="companyName">Lolishop</div>
                        <div id="navWrap">
                            <a href="/">Главная</a>
                            <a href="index.php?page=shop">Магазин</a>
                        </div>
                    </div> 
                </div>';
       }
    ?>

<!--А вот как реализована выгрузка данных из массива. Данные выгружаются в то место, где отрабатывает скрипт. Он динамически сменяет один набор контента на другой, при этом ты находишься на той же страние, хотя адрес может так же динамически меняться за счет выходных данных скрипта.-->

<div>
    <?php foreach ($goods as $good): ?>
        <div class="shopUnit">
            <a href="index.php?page=product&id=<?php echo $good['id']?>" class='shopUnitMoreBox'> 
                 <div class="img_wrapper">
                     <img src="<?php echo $good['img'];?>" onload="imgLoaded(this)"/>
                 </div>

                 <div class="TextBoxShop">
                 <div class="shopUnitName">
                    <?php echo $good['name']; ?>
                </div>
                <div class="shopUnitShortDesc">
                    <?php echo $good['desc']; ?>
                </div>
                <div class="shopUnitPrice">
                    Цена: <?php echo $good['price']; ?>
                </div>            
             </div>
            </a>   
        </div>
    <?php endforeach; ?>
</div>

<!--Или так-->

<div id="my-gallery" class="vanilla-zoom">
    <div class="sidebar">
        <img src="<?php echo $good['img']; ?>" class="small-preview">
        <img src="<?php echo $good['img2']; ?>" class="small-preview">
        <img src="<?php echo $good['img3']; ?>" class="small-preview">
        <img src="<?php echo $good['img4']; ?>" class="small-preview">
        <img src="<?php echo $good['img5']; ?>" class="small-preview">
    </div>
    <div class="zoomed-image"></div>
</div>

<div id="openedProduct-content">
    <h1 id="openedProduct-name">
        <?php echo $good['name']; ?>
    </h1>
    <div id="openedProduct-desc">
        <?php echo $good['desc']; ?>
    </div>
    <div id="openedProduct-price">
        Цена: <?php echo $good['price']; ?>
    </div>
    <div id="openedProduct-desc2">
        <?php echo $good['desc2']; ?>
    </div>
</div>