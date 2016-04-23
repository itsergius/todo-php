<?php

require('data.php');
require('functions.php');

// Создание нового таска
if(checkGet($_GET, 'submit_newTask')) {
    newTask($_GET);
};

// Добавление дополнительных полей к таску
if(checkGet($_GET, 'submit_taskDetails')) {
    updateTask($_GET);
};

// Смена Favorite task. Favorite task один.
if(checkGet($_GET, 'favorite')) {
    changeFavoriteTask($_GET);
};

// Смена статуса выполнен/не выполнен
if(checkGet($_GET, 'finished')) {
    updateFinished($_GET);
};

require('../views/index.php');