<?php

namespace LaravelVersio\Modules;

use LaravelVersio\LaravelVersio;

class DnsTemplate extends LaravelVersio
{
    public function lists()
    {
        $info = $this
            ->setGetUrl('dnstemplates')
            ->call();

        return array_get($info, 'dnstemplatesList');
    }

    public function get($dnsTemplate = null)
    {
        $info = $this
            ->setGetUrl('dnstemplates/' . $dnsTemplate)
            ->call();

        return array_get($info, 'dnstemplateInfo');
    }

    public function create($data = [])
    {
        $info = $this
            ->setParams($data)
            ->setPostUrl('dnstemplates')
            ->call();

        return array_get($info, 'dnstemplateInfo');
    }

    public function delete($dnsTemplate = null)
    {
        return $this
            ->setDeleteUrl('dnstemplates/' . $dnsTemplate)
            ->call();
    }

    public function update($dnsTemplate = null, $data = [])
    {
        $info = $this
            ->setParams($data)
            ->setPostUrl('dnstemplates/' . $dnsTemplate . '/update')
            ->call();

        return array_get($info, 'dnstemplateInfo');
    }
}
