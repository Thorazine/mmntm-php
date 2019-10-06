<?php

namespace Mmntm;

class Divider {

    private $title;
    private $robots;
    public $template;
    private $elements;
    private $statusCode;

    public function __construct(int $statusCode, $data)
    {
        // $this->title = @$data->title;
        $this->template = @$data->template;
        $this->title = @$data->title;
        $this->robots = @$data->robots;
        $this->elements = @$data->data;

        Helper::setProtocol($data->ssl);

        $this->statusCode = @$statusCode;
        $this->init($data);
    }

    public function __get($name)
    {
        if(@$this->elements->{$name}->value) {
            return @$this->elements->{$name}->value;
        }
        return @$this->{$name};
    }


    public function element($name, $type = '')
    {
        if($type) {
            return @$this->elements->{$name}->{$type};
        }
        return @$this->elements->{$name};
    }


    public function getTemplate()
    {
        return $this->template;
    }


    public function getTitle()
    {
        return $this->title;
    }


    public function getRobots()
    {
        return $this->robots;
    }


    // public function getElements()
    // {
    //     return $this->elements;
    // }


    // public function getStatusCode()
    // {
    //     return $this->statusCode;
    // }

    private function init($data)
    {
        $data = json_decode(json_encode($data), true);
        $keys = array_keys($data['data'])+array_keys($data);
        Helper::setKeys($keys);
    }
}
