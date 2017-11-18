<?php

if (!defined('BASEPATH')) {
    define('BASEPATH', true);
    require(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'constants.php');
}

if (!function_exists('hash_password')) {

    function hash_password($password, $salt)
    {
        return hash_pbkdf2("sha256", $password, $salt, HASH_ITERATIONS, HASH_LENGTH);
    }
}

if (!function_exists('random_salt')) {

    function random_salt()
    {
        return bin2hex(openssl_random_pseudo_bytes(SALT_LENGTH / 2));
    }
}

if (!function_exists('get_path')) {

    function get_path()
    {
        $path = uri_string();
        if (empty($path)) {
            $temp = new CI_Router();
            $path = $temp->default_controller;
        }
        return $path;
    }

}

if (!function_exists('arr_form')) {

    function arr_form($array)
    {
        return array_merge([0 => '-- Wybierz --'], $array);
    }
}