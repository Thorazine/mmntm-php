<?php

namespace Mmntm;

use Page;
use Parser;
use GuzzleHttp\Client;

class Get {

    public function __construct(string $key, boolean $test = false, string $domain = '', string $slug = '')
    {
        try {
            $client = new Client();
            $response = $client->request('POST', 'https://localhost/mmntm-api/public', [
                'form_params' => [
                    'key' => $key,
                    'domain' => ($domain) ? $domain : $this->domain(),
                    'slug' => ($slug) ? $slug : $this->slug(),
                ]
            ]);

            var_dump($response);

            return (new Parser($response))->get();
        }
        catch(Exception $e) {
            return new Page;
        }
    }

    private function domain()
    {
        return ($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
    }

    private function slug()
    {
        return trim(parse_url($url, PHP_URL_PATH), '/');
    }
}
