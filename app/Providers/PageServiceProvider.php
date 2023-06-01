<?php

namespace App\Providers;

use App\Models\BlockValues;
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
        // vendor/insyht/larvelous-base-blocks/resources/views/welcome.blade.php
        // The view can be loaded using the path:
        // insyht/larvelous-base-blocks/resources/views/welcome
        // This way, even if my view has the same name as a view from someone else (including in /resources/views),
        // they won't interfere with each other.
        view()->addLocation(__DIR__ . '/../../vendor');

        view()->composer('*', function (View $view) {
            if (!$view->offsetExists('page')) {
                return;
            }
            $page = $view->offsetGet('page');
            if (is_object($page)) {
                // Get the template for this page and get all blocks within that template. Then fetch all values for all
                // blocks and save it to those blocks so that the views can show them
                // todo Maybe I can improve on this. See Page->blocks() for an example.
                foreach ($page->template->blockTemplates as $blockTemplate) {
                    /** @var \App\Models\Block $block */
                    if ($view->getName() === $blockTemplate->block->getDottedViewPath()) {
                        $blockValues = new BlockValues();
                        foreach ($blockTemplate->blockVariableValueTemplateBlocks as $blockVariableValueTemplateBlock) {
                            $value = $blockVariableValueTemplateBlock->blockVariableValue;
                            $blockValues->{$value->blockVariable->name} = $value->value;
                        }
                        $blockTemplate->addValues($blockValues);
                    }
                }
            }
        });
    }
}
