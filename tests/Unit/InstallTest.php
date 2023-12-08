<?php

namespace Insyht\Larvelous\Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Insyht\Larvelous\Tests\TestCase;

class InstallTest extends TestCase
{
    /** @test */
    public function the_install_command_copies_the_configuration()
    {
        if (File::exists(config_path('insyht-larvelous.php'))) {
            unlink(config_path('insyht-larvelous.php'));
        }

        $this->assertFalse(File::exists(config_path('insyht-larvelous.php')));

        Artisan::call('insyht-larvelous:install');

        $this->assertTrue(File::exists(config_path('insyht-larvelous.php')));
    }
}
