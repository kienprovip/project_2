<?php

// Tu dong load config
$config_dir = scandir('configs');
if (!empty($config_dir)) {
    foreach ($config_dir as $item) {
        if ($item != '.' && $item != '..' && file_exists('configs/' . $item)) {
            require_once 'configs/' . $item;
        }
    }
}

require_once './configs/routes.php';
require_once './app/App.php';

// Kiem tra configs va load database
if (!empty($config['database'])) {
    $db_config = array_filter($config['database']);
    if (!empty($db_config)) {
        require_once './core/Connection.php';
        require_once './core/Database.php';
    }
}

require_once './core/Model.php';
require_once './core/BaseControlller.php'; // Load base controller
