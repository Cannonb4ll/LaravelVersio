<?php

namespace LaravelVersio;

use GuzzleHttp\Client;
use LaravelVersio\Modules\Domain;
use LaravelVersio\Modules\Tld;

class LaravelVersio
{
    const VERSION = 'v1';

    protected $url;
    protected $query;
    protected $callableUrl;

    public function __construct()
    {
        $this->client = new Client;

        $this->baseUrl = 'https://www.versio.nl';

        if (config('versio.test')) {
            $this->baseUrl .= '/testapi/' . self::VERSION . '/';
        } else {
            $this->baseUrl .= '/api/' . self::VERSION . '/';
        }
    }

    public function domains()
    {
        return new Domain;
    }

    public function tlds()
    {
        return new Tld;
    }

    protected function call()
    {
        $request = $this->client->request('GET', $this->callableUrl, [
            'auth' => [
                config('versio.email'),
                config('versio.password')
            ],
            'form_params' => [

            ]
        ]);

        return json_decode($request
            ->getBody()
            ->getContents(), true);
    }

    protected function setUrl($url = null)
    {
        $this->callableUrl = $this->baseUrl . $url . $this->query;
    }

    protected function addQuery(array $array)
    {
        $this->query = '?' . http_build_query($array);
    }
}

