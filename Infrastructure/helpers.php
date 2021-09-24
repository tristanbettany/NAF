<?php

if(function_exists('dd') === false) {
    function dd() {
        array_map(function($x) {
            var_dump($x);
        }, func_get_args());
        die;
    }
}

if(function_exists('vd') === false) {
    function vd() {
        array_map(function($x) {
            var_dump($x);
        }, func_get_args());
        die;
    }
}

if(function_exists('env') === false) {
    function env(string $key) {
        if (isset($_ENV[$key]) === false) {
            return null;
        }

        $value = $_ENV[$key];

        if (is_numeric($value) === true) {
            return (int) $value;
        }

        if (
            $value === ''
            || $value === 'null'
            || $value === 'NULL'
            || $value === null
        ) {
            return null;
        }

        if (
            $value === 'true'
            || $value === 'TRUE'
        ) {
            return true;
        }

        if (
            $value === 'false'
            || $value === 'FALSE'
        ) {
            return false;
        }

        return $value;
    }
}