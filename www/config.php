<?php
// CONFIG FILE

require_once('./vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

// LOAD CLASSES
$autoload = function ($class) {
    include('classes/' . $class . '.php');
};

spl_autoload_register($autoload);

// START SESSIONS
session_start();
