<?php

namespace LaravelVersio;

use GuzzleHttp\Client;
use LaravelVersio\Modules\DnsTemplate;
use LaravelVersio\Modules\Tld;
use LaravelVersio\Modules\Domain;
use LaravelVersio\Modules\Contact;

class LaravelVersio
{
    const VERSION = 'v1';

    protected $url;
    protected $query;
    protected $callableUrl;
    protected $method = 'GET';
    protected $params = [];

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

    public function contacts()
    {
        return new Contact;
    }

    public function dnsTemplate()
    {
        return new DnsTemplate;
    }

    protected function call()
    {
        $request = $this->client->request($this->method, $this->callableUrl . $this->query, [
            'auth' => [
                config('versio.email'),
                config('versio.password')
            ],
            'json' => $this->params
        ]);

        return json_decode($request
            ->getBody()
            ->getContents(), true);
    }

    protected function setGetUrl($url = null)
    {
        $this->method = 'GET';

        $this->callableUrl = $this->baseUrl . $url;

        return $this;
    }

    public function setPostUrl($url)
    {
        $this->method = 'POST';

        $this->callableUrl = $this->baseUrl . $url;

        return $this;
    }

    public function setDeleteUrl($url)
    {
        $this->method = 'DELETE';

        $this->callableUrl = $this->baseUrl . $url;

        return $this;
    }

    protected function addQuery(array $array)
    {
        $this->query = '?' . http_build_query($array);

        return $this;
    }

    protected function setParams(array $array)
    {
        $this->params = $array;

        return $this;
    }
}

