<?php

namespace Mmntm;

use Mmntm\Divider;
use GuzzleHttp\Client as Guzzle;

class Client {

    private $statusCode;
    private $body;
    private $response;
    private $domain;

    public function get(String $key, Bool $test = false, $domain = null, $slug = null)
    {
        try {
            $parameters = [
                'key' => $key,
                'domain' => ($domain) ? $domain : $this->domain($domain),
                'slug' => ($slug) ? $slug : $this->slug(),
            ];

            $guzzle = new Guzzle(['base_uri' => 'https://api.mmntm.nl']);
            $this->response = $guzzle->request('get', '', [
                'query' => $parameters,
                'http_errors' => false
            ]);

            // get the status code
            $this->statusCode();

            // check if we're alright
            if($this->statusCode != 200) {

                // create some debug data if in test mode
                if($test) {
                    echo 'Status code '.$this->statusCode.PHP_EOL.PHP_EOL;
                    echo 'Variables sent:'.PHP_EOL;
                    $parameters['key'] = '****** obfuscated ******';
                    var_dump($parameters);
                    die();
                }
                $this->abort($this->statusCode);
            }

            // load the body
            $this->body();

            Helper::setDomain(($domain) ? $domain : $this->domain());

            return new Divider($this->statusCode, json_decode($this->body));
        }
        catch(Exception $e) {

        }
    }

    private function domain($domain = '')
    {
        if($this->domain) {
            return $this->domain;
        }
        if(! $domain) {
            $this->domain = ($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
        }
        else {
            $this->domain = $domain;
        }
        return $this->domain;
    }

    private function slug()
    {
        return trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), '/');
    }

    /**
     * Load status code
     * @return [type] [description]
     */
    private function statusCode()
    {
        $this->statusCode = $this->response->getStatusCode();
    }

    /**
     * Load the body
     * @return [type] [description]
     */
    private function body()
    {
        $this->body = $this->response->getBody()->getContents();
    }

    /**
     * Abort the request
     * @param  integer $statusCode Status code
     * @return void
     */
    public function abort($statusCode = 403)
    {
        if(file_exists(__DIR__.'/views/errors/'.$statusCode.'.php')) {
            readfile(__DIR__.'/views/errors/'.$statusCode.'.php');
        }
        elseif(in_array($statusCode, [404, 403, 500])) {
            readfile(__DIR__.'/../views/errors/'.$statusCode.'.php');
        }
        else {
            readfile(__DIR__.'/../views/errors/500.php');
        }
        die();
    }
}
