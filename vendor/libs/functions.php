<?php
function dd($data)
{
    echo '<pre>' . print_r($data, true) . '</pre>';
}

function redirect($http = false)
{
    if ($http) {
        $redirect = $http;
    } else {
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
    }
    header("Location: $redirect");
    exit;
}
function h ($str){
    return htmlspecialchars($str, ENT_QUOTES);
}