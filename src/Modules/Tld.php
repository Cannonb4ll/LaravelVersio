<?php

namespace LaravelVersio\Modules;

use LaravelVersio\LaravelVersio;

class Tld extends LaravelVersio
{
    protected $arrayKey = 'tldIinfo';

    public function prices()
    {
        $this->setUrl('tld/info');

        return array_get($this->call(), $this->arrayKey);
    }

    public function info($tld = null)
    {
        $this->setUrl('tld/info/' . $tld);

        $info = array_get($this->call(), $this->arrayKey);

        if ($info && is_array($info)) {
            return $info[0];
        }

        return $info;
    }
}