<?php

namespace LaravelVersio\Modules;

use LaravelVersio\LaravelVersio;

class Domain extends LaravelVersio
{
    protected $arrayKey = 'domainInfo';

    public function get($domain = null)
    {
        $this->setUrl('domains/' . $domain);

        return array_get($this->call(), $this->arrayKey);
    }

    public function getDnsRecords($domain = null)
    {
        $this->addQuery([
            'show_dns_records' => 'true'
        ]);

        $this->setUrl('domains/' . $domain);

        return array_get($this->call(), $this->arrayKey . '.dns_records');
    }

    public function getNameservers($domain = null)
    {
        $this->setUrl('domains/' . $domain);

        return array_get($this->call(), $this->arrayKey . '.ns');
    }

    public function available($domain = null)
    {
        $this->setUrl('domains/' . $domain . '/availability');

        $info = $this->call();

        if ($info && is_array($info)) {
            return $info[0];
        }

        return $info;
    }
}