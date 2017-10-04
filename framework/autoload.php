<?php

spl_autoload_register(function ($class_name) {
    include ROOT_DIR . '/' . $class_name . '.php';
});
