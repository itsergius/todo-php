<?php

// Проверка GET/POST
function checkGet($get, $key) {
    if(count($get)) {
        if(isset($get[$key])) {
            return true;
        }
    } else { return false; }
}

// Проверка, есть ли таски
function issetAnyTask() {
    $files = scandir('tasks/');
    unset($files[0],$files[1]);
    if(count($files)) {
        return true;
    } else { return false; }
}

// Проверка, есть ли Favorite task
function issetFavoriteTask() {
    if(!empty(file_get_contents('favorite_task.txt'))) {
        return true;
    } else { return false; }
}

// Поиск таска по имени
function findTask($arg) {
    $tasks = getTasks();
    $taskValue = [];
    if(!empty($arg)) {
        if (isset($arg)) {
            foreach ($tasks as $key => $value) {
                if ($arg == $value['name']) {
                    $taskValue = [$value];
                }
            }
        }
    }
    return $taskValue;
}

// Поиск название файла таска
function findTaskFileName($arg) {
    $tasks = getFileName();
    $taskFileName = '';
    if(!empty($arg)) {
        if (isset($arg)) {
            foreach ($tasks as $key => $value) {
                if ($arg == $value['name']) {
                    $taskFileName = $key;
                }
            }
        }
    }
    return $taskFileName;
}

// Массив с тасками. Ключ 0-9.
function getTasks() {
    $tasks = array();
    $files = scandir('tasks/');
    unset($files[0],$files[1]);
    foreach ($files as $key => $value) {
        $description = getDescFromFile($value);
        $tasks[$key] = $description;
    }
    return $tasks;
}

// Массив с тасками. Ключ - название файла.
function getFileName() {
    $tasks = array();
    $files = scandir('tasks/');
    unset($files[0],$files[1]);
    foreach ($files as $key => $value) {
        $description = getDescFromFile($value);
        $tasks[$value] = $description;
    }
    return $tasks;
}

// Извлечение описания таска из файла
function getDescFromFile($path) {
    $desc = array();
    $pathToFile = 'tasks/' . $path;
    $desc = json_decode(file_get_contents($pathToFile), true);
    return $desc;
}

// Создание нового таска
function newTask($arg) {
    unset($arg['submit_newTask']);
    $file = 'tasks/' . time() . '.txt';
    if(!isset($arg['date']) || empty($arg['date'])) {
        $arg['date'] = 'Please, set a date!';
    }
    if(empty($arg['name'])) {
        $arg['name'] = 'Error: task is empty!';
    }
    if(!isset($arg['note'])) {
        $arg['note'] = '';
    }
    if(!isset($arg['finished'])) {
        $arg['finished'] = 'no';
    }
    $content = json_encode($arg);
    file_put_contents($file, $content);
}

// Смена статуса выполнен/не выполнен
function updateFinished($arg) {
    $tasks = getFileName();
    foreach($tasks as $key => $task) {
        if($task['name'] == $arg['name']) {
            $task['finished'] = $arg['finished'];
            $task = json_encode($task);
            $file = 'tasks/' . $key;
            file_put_contents($file, $task);
        }
    }
}

// Добавление дополнительных полей к таску
function updateTask($arg) {
    unset($arg['submit_taskDetails']);
    unset($arg['favorite']);
    $file = 'tasks/' . $arg['file'];
    unset($arg['file']);
    $content = json_encode($arg);
    file_put_contents($file, $content);
}

// Смена Favorite task
function changeFavoriteTask($arg) {
            $file = 'favorite_task.txt';
            $content = $arg['favorite'];
            file_put_contents($file, $content);
}

// Чтение Favorite task
function readFavoriteTask() {
    $file = 'favorite_task.txt';
    $favoriteFile = file_get_contents($file);
    foreach(getFileName() as $key => $value) {
        if($favoriteFile == $key) {
            $favoriteTask = $value;
        }
    }
    return $favoriteTask;
}
