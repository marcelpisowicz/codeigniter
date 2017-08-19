<?php

if(!defined('BASEPATH')) {
    define('BASEPATH', true);
    require(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'constants.php');
}

if (!function_exists('passwordHash')) {

    function hash_password($password, $salt) {
        return hash_pbkdf2("sha256", $password, $salt, HASH_ITERATIONS, HASH_LENGTH);
    }
}

if (!function_exists('randomSalt')) {

    function random_salt() {
        return bin2hex(openssl_random_pseudo_bytes(SALT_LENGTH/2));
    }
}