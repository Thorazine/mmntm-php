<?php

namespace MmntmPhp;

class Parser {

    private $response;
    private $statusCode = '200';

    public function __construct($response)
    {
        $this->response = $response;
    }


    private function statusCode()
    {
        $this->statusCode = $this->response->getStatusCode();
    }
}
