<?php

namespace LaravelVersio\Modules;

use LaravelVersio\LaravelVersio;

class Contact extends LaravelVersio
{
    public function lists()
    {
        $info = $this
            ->setGetUrl('contacts')
            ->call();

        return array_get($info, 'ContactList');
    }

    public function get($contactId)
    {
        $info = $this
            ->setGetUrl('contacts/' . $contactId)
            ->call();

        return array_get($info, 'contactInfo');
    }

    public function create(array $data = [])
    {
        if (!count($data)) {
            return;
        }

        return $this
            ->setParams($data)
            ->setPostUrl('contacts')
            ->call();
    }

    public function delete($contactId)
    {
        $info = $this
            ->setDeleteUrl('contacts/' . $contactId)
            ->call();

        return $info;
    }
}
