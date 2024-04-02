<?php

namespace Insyht\Larvelous\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class PageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Add the composer vendor directory to the places to search for Blade views. This way, every developer
        // can add Blade views to the CMS, for blocks for instance. For example, if I place a Blade view in:
        // vendor/insyht/larvelous-shop/resources/views/welcome.blade.php
        // The view can be loaded using the path:
        // insyht/larvelous-shop/resources/views/welcome
        // This way, even if my view has the same name as a view from someone else (including in /resources/views),
        // they won't interfere with each other.
        view()->addLocation(__DIR__ . '/../../vendor');

        view()->composer('*', function (View $view) {
            if (!$view->offsetExists('page')) {
                return;
            }
            $page = $view->offsetGet('page');
            if (is_object($page)) {
                /** @var \Insyht\Larvelous\Models\Page $page */
                // Fetch all values for all blocks of this page and save it to those blocks so the views can show them
                $page->setContents();
            }
        });
    }
}
