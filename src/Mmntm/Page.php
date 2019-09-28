<?php

namespace Mmntm;

class Page {

    private $data;

    public function __get($name)
    {
        return @$this->{$name};
    }


    public function set($data)
    {

    }
}
