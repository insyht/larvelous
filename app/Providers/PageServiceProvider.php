<?php

namespace App\Providers;

use App\BlockValues;
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
        // vendor/iws/resources/views/welcome.blade.php
        // The view can be loaded using the path:
        // iws/resources/views/welcome
        // This way, even if my view has the same name as a view from someone else (including in /resources/views),
        // they won't interfere with each other.
        view()->addLocation(__DIR__ . '/../../vendor');

        view()->composer('*', function(View $view) {
            $page = $view->offsetGet('page');

            // For all block views, save the values for this block on this view.
            // They can be fetched from the block using $block->getBlockValues($index) in a template,
            // where $index is the nth iteration of this block on this page
            foreach ($page->template->blocks as $block) {
                /** @var \App\Block $block */
                if ($view->getName() === $block->getDottedViewPath()) {

                    $blockValues = [];
                    $requiredValueProperties = $block->blockVariables()->pluck('name');
                    foreach ($requiredValueProperties as $property) {
                        $values = $block->get($page->template, $property);
                        if (empty($blockValues)) {
                            foreach ($values as $index => $value) {
                                /** @var \App\BlockVariableValue $value */
                                $propertyName = $value->blockVariable->name;
                                $blockValue = new BlockValues();
                                $blockValue->$propertyName = $value->value;
                                $blockValues[$index] = $blockValue;
                            }
                        } else {
                            foreach ($values as $index => $value) {
                                /** @var \App\BlockVariableValue $value */
                                $propertyName = $value->blockVariable->name;
                                $blockValues[$index]->$propertyName = $value->value;
                            }
                        }
                    }
                    foreach ($blockValues as $blockValue) {
                        $block->addValues($blockValue);
                    }
                }
            }
        });
    }
}
