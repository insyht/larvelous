<?php

namespace App\Providers;

use App\BlockValues;
use App\BlockVariableValueTemplateBlock;
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

        view()->composer('*', function (View $view) {
            if (!$view->offsetExists('page')) {
                return;
            }
            $page = $view->offsetGet('page');
            // todo || Ik moet nog eens goed kijken of ik de databasewaardes wel goed interpreteer. Ik zou nu 2
            // todo || paragraph blocks moeten hebben. Eentje met een titel, text en link,
            // todo || en eentje met titel, text, afbeelding, link en link text.. Volgens mij gebruik ik o.a.
            // todo || block_variable_value_template_blocks.ordering verkeerd

            // For all block views, save the values for this block on this view.
            // They can be fetched from the block using $block->getBlockValues($index) in a template,
            // where $index is the nth iteration of this block on this page
            // todo uiteindelijk $block->addValues() voor elk $block
            foreach ($page->template->blockTemplates as $blockTemplate) {
                /** @var \App\Block $block */
                if ($view->getName() === $blockTemplate->block->getDottedViewPath()) {
                    $blockValues = new BlockValues();
                    foreach ($blockTemplate->blockVariableValueTemplateBlocks as $blockVariableValueTemplateBlock) {
                        $value = $blockVariableValueTemplateBlock->blockVariableValue;
                        $blockValues->{$value->blockVariable->name} = $value->value;
                    }
                    $blockTemplate->addValues($blockValues);
                }
            }
        });
    }
}
