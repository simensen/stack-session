<?php

namespace shared;

use Pimple;
use Stack\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use Symfony\Component\HttpKernel\HttpKernelInterface;

trait Sessionify
{
    private $mockFileSessionStorage;

    protected function setUpMockFileSessionStorage()
    {
        $this->mockFileSessionStorage = new MockFileSessionStorage();
    }

    protected function sessionify(HttpKernelInterface $app, array $config = [])
    {
        $config = array_merge([
            'session.storage' => Pimple::share(function () {
                return $this->mockFileSessionStorage;
            }),
        ], $config);

        return new Session($app, $config);
    }
}
