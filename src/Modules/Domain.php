<?php

namespace LaravelVersio\Modules;

use LaravelVersio\LaravelVersio;

class Domain extends LaravelVersio
{
    protected $arrayKey = 'domainInfo';

    public function lists()
    {
        $info = $this
            ->setGetUrl('domains')
            ->call();

        return array_get($info, 'DomainsList');
    }


    public function get($domain = null)
    {
        $info = $this
            ->setGetUrl('domains/' . $domain)
            ->call();

        return array_get($info, $this->arrayKey);
    }

    public function setNameServerManagement($domain)
    {
        return $this->update($domain, [
            'dns_management' => false
        ]);
    }

    public function setDnsManagement($domain)
    {
        return $this->update($domain, [
            'dns_management' => true
        ]);
    }

    public function getDnsRecords($domain = null)
    {
        $info = $this
            ->setGetUrl('domains/' . $domain)
            ->addQuery([
                'show_dns_records' => 'true'
            ])
            ->call();

        return array_get($info, $this->arrayKey . '.dns_records');
    }

    public function getRedirects($domain = null)
    {
        $info = $this
            ->setGetUrl('domains/' . $domain)
            ->addQuery([
                'show_domain_records' => 'true'
            ])
            ->call();

        return array_get($info, $this->arrayKey . '.dns_redirections');
    }

    public function getMovingCode($domain)
    {
        $data = $this
            ->setGetUrl('domains/' . $domain)
            ->addQuery([
                'show_epp_code' => 'true'
            ])
            ->call();

        return array_get($data, $this->arrayKey . '.epp_code');
    }

    public function getNameservers($domain = null)
    {
        $info = $this
            ->setGetUrl('domains/' . $domain)
            ->call();

        return array_get($info, $this->arrayKey . '.ns');
    }

    public function register($domain, $contactId = null, $years = 1, $ns = [])
    {
        return $this
            ->setParams([
                'ns' => count($ns) ? $ns : null,
                'years' => $years,
                'contact_id' => $contactId,
            ])
            ->setPostUrl('domains/' . $domain)
            ->call();
    }

    public function renew($domain, $years = 1)
    {
        return $this
            ->setParams([
                'years' => $years
            ])
            ->setPostUrl('domains/' . $domain . '/renew')
            ->call();
    }

    public function update($domain, array $data = [])
    {
        if (!count($data)) {
            return;
        }

        return $this
            ->setParams($data)
            ->setPostUrl('domains/' . $domain . '/update')
            ->call();
    }

    public function available($domain = null)
    {
        $info = $this
            ->setGetUrl('domains/' . $domain . '/availability')
            ->call();

        if ($info && is_array($info)) {
            return $info[0];
        }

        return $info;
    }
}
