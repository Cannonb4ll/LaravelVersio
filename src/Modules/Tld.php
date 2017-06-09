<?php

namespace LaravelVersio\Modules;

use LaravelVersio\LaravelVersio;

class Tld extends LaravelVersio
{
    protected $arrayKey = 'tldInfo';

    public function prices()
    {
        $this->setGetUrl('tld/info');

        return array_get($this->call(), $this->arrayKey);
    }

    public function info($tld = null)
    {
        $data = $this
            ->setGetUrl('tld/info/' . $tld)
            ->call();

        $info = array_get($data, $this->arrayKey);

        if ($info && is_array($info)) {
            return $info[0];
        }

        return $info;
    }
}