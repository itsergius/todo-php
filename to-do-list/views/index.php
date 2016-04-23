<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>To do list</title>

    <meta name="description" content="">

    <link rel="stylesheet" href="css/base.css">
    <!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css"><![endif]-->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/autosize.min.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
    <!--[if lte IE 9]><script type="text/javascript" src="js/placeholder.js"></script><![endif]-->
</head>
<body>
<div class="content">

    <div class="wrapper">
        <div class="app-container">
            <header class="app-header">
                <button class="preferences-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <h1 class="header-title"><a href="">All tasks</a></h1>
                <button class="search-btn">
                    <span>&#xf002;</span>
                </button>
                <button class="add-btn">
                </button>
                <section class="new-task-container">
                    <div class="add-task">
                        <!-- Добавление нового таска  -->
                        <form action="" method="GET">
                            <input type="text" name="name" placeholder="Add a new task">
                            <input type="hidden" name="submit_newTask" placeholder="Add a new task">
                        <div class="task-options">
                            <button class="favorite">
                                <span>&#xf006;</span>
                            </button>
                            <button class="date">
                                <span>&#xf073;</span>
                            </button>
                            <button class="category red-palette"></button>
                        </div>
                    </div>
                    <div class="select-category">
                        <span>Select a category</span>
                        <!-- Вывожу категории из массива, для первой категории устанавливаю атрибут checked -->
                        <div class="category-list">
                            <?php foreach($categories as $key => $category) {
                                if($key == 0) { ?>
                                    <div class="<?= $category['name'] ?>-palette">
                                        <input type="radio" name="category" class="addCat" value="<?= $category['name'] ?>" checked>
                                        <span><?= $category['symbol'] ?></span>
                                    </div>
                                <?php } else { ?>
                                    <div class="<?= $category['name'] ?>-palette">
                                        <input type="radio" name="category" class="addCat" value="<?= $category['name'] ?>">
                                        <span><?= $category['symbol'] ?></span>
                                    </div>
                                <?php }
                            } ?>
                        </div>
                    </div>
                    </form>
                </section>
                <section class="search-section">
                    <span>&#xf002;</span>
                    <!-- Поиск таска  -->
                    <form action="" method="GET" class="form_search">
                        <input type="text" name="search" placeholder="search">
                    </form>
                </section>
            </header>
            <section class="app-body">
                <div class="main-nav">
                    <ul class="navbar">
                        <li class="grey-palette selected">
                            <span><a href="./">&#xf01c;</a></span>
                        </li>
                        <!-- Подставляю категории из массива -->
                        <?php foreach($categories as $category) { ?>
                        <li class="<?= $category['name'] ?>-palette">
                            <form action="" method="GET">
                                <input type="hidden" name="category" value="<?= $category['name'] ?>">
                                <input type="submit" name="send_category" value="<?= $category['name'] ?>" class="button--navbar">
                            </form>
                            <span><?= $category['symbol'] ?></span>
                        </li>
                        <?php } ?>
                    </ul>
                    <button class="setting-btn">&#xf013;</button>
                </div>
                <div class="task-container">
                    <!-- Добавление дополнительных полей для таска  -->
                    <div class="task-details
                    <?php
                        if(checkGet($_GET, 'class')) {
                            echo $_GET['class'] . ' ';
                        };
                            echo findTask($_GET['name'])[0]['category']; ?>-palette-helper">
                        <form action="" method="get">
                        <ul>
                            <li>
                                <div class="styled-check">
                                    <input type="checkbox" id="check1" name="progress">
                                    <label for="check1"><span></span></label>
                                </div>
                                <h2><?= findTask($_GET['name'])[0]['name']; ?></h2>
                                <input type="hidden" name="name" value="<?= findTask($_GET['name'])[0]['name']; ?>">
                                <input type="hidden" name="category" value="<?= findTask($_GET['name'])[0]['category']; ?>">
                                <input type="hidden" name="file" value="<?= findTaskFileName($_GET['name']); ?>">
                                <input type="hidden" name="finished" value="no">
                                <input type="checkbox" class="checkbox_addfields" name="favorite" value="<?= findTaskFileName($_GET['name']); ?>">
                                <button class="favorite">&#xf006;</button>

                            </li>
                            <li>
                                <button class="add-detail calendar"></button>
                                <span><input type="date" name="date" placeholder="Set a date" value="<?= findTask($_GET['name'])[0]['date']; ?>" style="color: rgba(255, 255, 255, 0.5);font-family: open_sanssemibold, Arial, sans-serif; font-size: 14px; background-color: transparent; border:0;"></span>
                            </li>
                            <li>
                                <button class="add-detail reminder">
                                    <span>Set a reminder</span>
                                </button>
                            </li>
                            <li>
                                <button class="add-detail category is-set">
                                    <span>Home</span>
                                </button>
                            </li>
                            <li>
                                <span class="note-icon">&#xf044;</span>
                                <textarea rows="12" class="note" name="note" placeholder="Add note"><?= findTask($_GET['name'])[0]['note']; ?></textarea>
                            </li>
                        </ul>

                            <input type="submit" name="submit_taskDetails" class="submit_tdetails" value="Submit">
                        </form>
                    </div>
                    <!-- Проверка, есть ли таски -->
                    <?php if(!issetAnyTask()) { ?>
                    <div class="task">
                        <div class="styled-check">
                            <input type="checkbox" id="check2" name="progress">
                            <label for="check2"><span></span></label>
                        </div>
                        <div class="task-inner">
                            <header class="task-header cf">
                                <div class="favorite">
                                    <span>&#xf005;</span>
                                </div>
                            </header>
                            <div class="task-text">
                                <span>There is no task!</span>
                            </div>
                        </div>
                    </div>
                    <?php } else { ?>
                    <!-- Если таски есть, то проверка, есть ли Favorite task -->
                    <?php if(issetFavoriteTask()) { ?>
                        <div class="task <?= readFavoriteTask()['category']; ?>-palette-helper">
                            <div class="styled-check">
                                <input type="checkbox" id="check2" name="progress">
                                <label for="check2"><span></span></label>
                            </div>
                            <div class="task-inner">
                                <header class="task-header cf">
                                    <div class="info">
                                        <time><?= readFavoriteTask()['date']; ?></time>
                                    </div>
                                    <div class="favorite">
                                        <span>&#xf005;</span>
                                    </div>
                                </header>
                                <div class="task-text">
                                    <span><?= readFavoriteTask()['name']; ?></span>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col-12">
                        <!-- Левая колонка -->
                        <div class="col-6">
                        <?php
                            // Если есть Фильтр по категориям
                            if(checkGet($_GET, 'send_category')) {
                                foreach(getTasks() as $key => $task) {
                                    if(in_array($_GET['category'], $task)) {
                                        // Выводить только чётные таски
                                        if($key%2==0) { ?>
                                            <div class="task <?= $task['category'] ?>-palette-helper">
                                                <div class="styled-check">
                                                    <input type="checkbox" id="<?= $key ?>" name="progress">
                                                    <label for="check3"><span></span></label>
                                                </div>
                                                <div class="task-inner">
                                                    <header class="task-header cf">
                                                        <div class="info">
                                                            <time><?= $task['date'] ?></time>
                                                        </div>
                                                    </header>
                                                    <div class="task-text">
                                                        <span><a href="?class=active&name=<?= $task['name'] ?>"><?= $task['name'] ?></a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                    }
                                }
                            // Если есть Запрос поиска
                            } elseif(checkGet($_GET, 'search')) {
                                foreach(getTasks() as $key => $task) {
                                    $catname = $task['name'];
                                    $search = $_GET['search'];
                                    $pos = strripos($catname, $search);
                                    if($pos !== false) {
                                        if($key%2==0) { ?>
                                            <div class="task <?= $task['category'] ?>-palette-helper">
                                                <div class="styled-check">
                                                    <input type="checkbox" id="<?= $key ?>" name="progress">
                                                    <label for="check3"><span></span></label>
                                                </div>
                                                <div class="task-inner">
                                                    <header class="task-header cf">
                                                        <div class="info">
                                                            <time><?= $task['date'] ?></time>
                                                        </div>
                                                    </header>
                                                    <div class="task-text">
                                                        <span><a href="?class=active&name=<?= $task['name'] ?>"><?= $task['name'] ?></a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                    }
                                }
                            } else {
                                // Если нет ни фильтра по категориям, ни поиска
                                foreach(getTasks() as $key => $task) {
                                    // Вывод Не выполненных тасков наверх
                                    if ($task['finished'] !== 'yes') {
                                        if ($key % 2 == 0) { ?>
                                            <div class="task <?= trim($task['category']) ?>-palette-helper">
                                                <div class="styled-check">
                                                    <form action="" method="get">
                                                        <input type="checkbox" id="<?= $key ?>" name="progress">
                                                        <label for="<?= $key ?>"><span></span></label>
                                                        <input type="hidden" name="name" value="<?= $task['name'] ?>">
                                                        <input type="submit" name="finished" value="yes" class="submit_finished">
                                                    </form>
                                                </div>
                                                <div class="task-inner">
                                                    <header class="task-header cf">
                                                        <div class="info">
                                                            <time><?= $task['date'] ?></time>
                                                        </div>
                                                    </header>
                                                    <div class="task-text">
                                                        <span><a
                                                                href="?class=active&name=<?= $task['name'] ?>"><?= $task['name'] ?></a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                    }
                                    // Вывод Выполненных тасков вниз
                                    if($task['finished'] == 'yes') {
                                        $finishedTask[] = $task;
                                    }
                                }
                                if(isset($finishedTask)) {
                                    foreach($finishedTask as $key => $task) {
                                        if ($key % 2 == 0) { ?>
                                            <div class="task <?= trim($task['category']) ?>-palette-helper task-done">
                                                <div class="styled-check">
                                                    <form action="" method="get">
                                                        <input type="checkbox" id="<?= $key ?>" name="progress" checked>
                                                        <label for="<?= $key ?>"><span></span></label>
                                                        <input type="hidden" name="name" value="<?= $task['name'] ?>">
                                                        <input type="submit" name="finished" value="no" class="submit_finished">
                                                    </form>
                                                </div>
                                                <div class="task-inner">
                                                    <header class="task-header cf">
                                                        <div class="info">
                                                            <time><?= $task['date'] ?></time>
                                                        </div>
                                                    </header>
                                                    <div class="task-text">
                                                            <span><a
                                                                    href="?class=active&name=<?= $task['name'] ?>"><?= $task['name'] ?></a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                    }
                                }
                            } ?>
                        </div>
                        <div class="col-6">
                            <!-- Правая колонка -->
                            <?php
                            // Если есть Фильтр по категориям
                            if(checkGet($_GET, 'send_category')) {
                                foreach(getTasks() as $key => $task) {
                                    if(in_array($_GET['category'], $task)) {
                                        // Выводить только Нечётные таски
                                        if($key%2!==0) { ?>
                                            <div class="task <?= $task['category'] ?>-palette-helper">
                                                <div class="styled-check">
                                                    <input type="checkbox" id="<?= $key ?>" name="progress">
                                                    <label for="check3"><span></span></label>
                                                </div>
                                                <div class="task-inner">
                                                    <header class="task-header cf">
                                                        <div class="info">
                                                            <time><?= $task['date'] ?></time>
                                                        </div>
                                                    </header>
                                                    <div class="task-text">
                                                        <span><a href="?class=active&name=<?= $task['name'] ?>"><?= $task['name'] ?></a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                    }
                                }
                                // Если есть Запрос поиска
                            } elseif(checkGet($_GET, 'search')) {
                                foreach(getTasks() as $key => $task) {
                                    $catname = $task['name'];
                                    $search = $_GET['search'];
                                    $pos = strripos($catname, $search);
                                    if($pos !== false) {
                                        if($key%2!==0) { ?>
                                            <div class="task <?= $task['category'] ?>-palette-helper">
                                                <div class="styled-check">
                                                    <input type="checkbox" id="<?= $key ?>" name="progress">
                                                    <label for="check3"><span></span></label>
                                                </div>
                                                <div class="task-inner">
                                                    <header class="task-header cf">
                                                        <div class="info">
                                                            <time><?= $task['date'] ?></time>
                                                        </div>
                                                    </header>
                                                    <div class="task-text">
                                                        <span><a href="?class=active&name=<?= $task['name'] ?>"><?= $task['name'] ?></a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                    }
                                }
                            } else {
                                // Если нет ни фильтра по категориям, ни поиска
                                foreach(getTasks() as $key => $task) {
                                    // Вывод Не выполненных тасков наверх
                                    if ($task['finished'] !== 'yes') {
                                        if ($key % 2 !== 0) { ?>
                                            <div class="task <?= trim($task['category']) ?>-palette-helper">
                                                <div class="styled-check">
                                                    <form action="" method="get">
                                                        <input type="checkbox" id="<?= $key ?>" name="progress">
                                                        <label for="<?= $key ?>"><span></span></label>
                                                        <input type="hidden" name="name" value="<?= $task['name'] ?>">
                                                        <input type="submit" name="finished" value="yes" class="submit_finished">
                                                    </form>
                                                </div>
                                                <div class="task-inner">
                                                    <header class="task-header cf">
                                                        <div class="info">
                                                            <time><?= $task['date'] ?></time>
                                                        </div>
                                                    </header>
                                                    <div class="task-text">
                                                        <span><a
                                                                href="?class=active&name=<?= $task['name'] ?>"><?= $task['name'] ?></a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                    }
                                }
                                if(isset($finishedTask)) {
                                    foreach($finishedTask as $key => $task) {
                                        if ($key % 2 !== 0) { ?>
                                            <div class="task <?= trim($task['category']) ?>-palette-helper task-done">
                                                <div class="styled-check">
                                                    <form action="" method="get">
                                                        <input type="checkbox" id="<?= $key ?>" name="progress" checked>
                                                        <label for="<?= $key ?>"><span></span></label>
                                                        <input type="hidden" name="name" value="<?= $task['name'] ?>">
                                                        <input type="submit" name="finished" value="no" class="submit_finished">
                                                    </form>
                                                </div>
                                                <div class="task-inner">
                                                    <header class="task-header cf">
                                                        <div class="info">
                                                            <time><?= $task['date'] ?></time>
                                                        </div>
                                                    </header>
                                                    <div class="task-text">
                                                            <span><a
                                                                    href="?class=active&name=<?= $task['name'] ?>"><?= $task['name'] ?></a></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }
                                    }
                                }
                            } ?>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="calendar-box">
                        <div class="calendar-head">
                            <table>
                                <tr class="month-carousel">
                                    <td colspan="7">
                                        <a href="#" class="carousel-control left">
                                            <span>&#xf104;</span>
                                        </a>
                                        <div class="carousel-inner">
                                            <div class="item">
                                                September
                                            </div>
                                        </div>
                                        <a href="#" class="carousel-control right">
                                            <span>&#xf105;</span>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="week-days">
                                    <td>MON</td>
                                    <td>TUE</td>
                                    <td>WED</td>
                                    <td>THU</td>
                                    <td>FRI</td>
                                    <td>SAT</td>
                                    <td>SUN</td>
                                </tr>
                            </table>
                        </div>
                        <div class="calendar-body">
                            <table class="month-days">
                                <tr>
                                    <td class="prev-next-month">24</td>
                                    <td class="prev-next-month">25</td>
                                    <td class="prev-next-month">26</td>
                                    <td class="prev-next-month">27</td>
                                    <td class="prev-next-month">28</td>
                                    <td>1</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>6</td>
                                    <td>7</td>
                                    <td>8</td>
                                    <td>9</td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>11</td>
                                    <td class="active">12</td>
                                    <td>13</td>
                                    <td>14</td>
                                    <td>15</td>
                                    <td>16</td>
                                </tr>
                                <tr>
                                    <td>17</td>
                                    <td>18</td>
                                    <td>19</td>
                                    <td>20</td>
                                    <td>21</td>
                                    <td>22</td>
                                    <td>23</td>
                                </tr>
                                <tr>
                                    <td>24</td>
                                    <td>25</td>
                                    <td>26</td>
                                    <td>27</td>
                                    <td>28</td>
                                    <td class="prev-next-month">1</td>
                                    <td class="prev-next-month">2</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

</body>
</html>