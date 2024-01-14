<?php

namespace Insyht\Larvelous\Tests;

use Insyht\Larvelous\LarvelousServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            LarvelousServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {

    }
}
