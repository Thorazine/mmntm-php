<?php

namespace Mmntm;

class Helper {

    protected static $keys = [];
    protected static $domain = '';
    protected static $protocol = 'http://';

    public static function setKeys($keys)
    {
        self::$keys = $keys;
    }

    public static function setDomain($domain)
    {
        self::$domain = $domain;
    }

    public static function getDomain()
    {
        return self::$domain;
    }

    public static function setProtocol($protocol)
    {
        self::$protocol = ($protocol) ? 'https://' : 'http://';
    }

    public static function getProtocol()
    {
        return self::$protocol;
    }

    public static function keys()
    {
        $keys = self::$keys;
        include __DIR__.'/../views/data.php';
    }
}
