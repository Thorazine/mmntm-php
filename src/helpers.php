<?php
use Mmntm\Helper;

if( ! function_exists('asset') ) {
    function asset($path = '')
    {
        return Helper::getProtocol().Helper::getDomain().'/'.ltrim($path, '/');
    }
}

if( ! function_exists('url') ) {
    function url($path = '')
    {
        return Helper::getProtocol().Helper::getDomain().'/'.ltrim($path, '/');
    }
}

if( ! function_exists('getPath') ) {
    function getPath($value, $limit = 0, $order = 'id', $direction = 'desc')
    {
        Helper::getPath($value, $limit, $order, $direction);
    }
}


if( ! function_exists('keys') ) {
    function keys($value)
    {
        Mmntm\Helper::keys(); // build helper
    }
}

if( ! function_exists('dd') ) {
    function dd($value)
    {
        var_dump($value);
        die();
    }
}
