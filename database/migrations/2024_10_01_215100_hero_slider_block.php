<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Insyht\Larvelous\Forms\Components\Number;
use Insyht\Larvelous\Forms\Components\Slide;
use Insyht\Larvelous\Models\Block;
use Insyht\Larvelous\Models\BlockVariable;
use Insyht\Larvelous\Models\BlockVariableType;

class HeroSliderBlock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('block_variable_values', function (Blueprint $table) {
            $table->boolean('is_json')->default(false);
        });

        $blockVariableTypeSlide = new BlockVariableType();
        $blockVariableTypeSlide->name = 'slide';
        $blockVariableTypeSlide->fqn = Slide::class;
        $blockVariableTypeSlide->save();

        // blocks
        $heroSliderBlock = new Block();
        $heroSliderBlock->resource_id = 'iws_hero_slider';
        $heroSliderBlock->view = 'blocks.hero-slider';
        $heroSliderBlock->label = 'Hero slider';
        $heroSliderBlock->description = 'A slider with slides that contain an image and an optional text block';
//        $heroSliderBlock->multilayered = true;
        $heroSliderBlock->save();
        $heroSliderBlock->refresh();

        // blocks_variables
        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $heroSliderBlock->id;
        $blockVariable->name = 'slide';
        $blockVariable->label = 'cms.slide';
        $blockVariable->type = BlockVariableType::TYPE_SLIDE;
        $blockVariable->required = 1;
        $blockVariable->ordering = 1;
        $blockVariable->save();
//
//        $blockVariable = new BlockVariable();
//        $blockVariable->block_id = $heroSliderBlock->id;
//        $blockVariable->name = 'image';
//        $blockVariable->label = 'cms.image';
//        $blockVariable->type = BlockVariableType::TYPE_IMAGE;
//        $blockVariable->required = 1;
//        $blockVariable->ordering = 2;
//        $blockVariable->save();
//
//        $blockVariable = new BlockVariable();
//        $blockVariable->block_id = $heroSliderBlock->id;
//        $blockVariable->name = 'text';
//        $blockVariable->label = 'cms.text';
//        $blockVariable->type = BlockVariableType::TYPE_TEXTAREA;
//        $blockVariable->required = 0;
//        $blockVariable->ordering = 3;
//        $blockVariable->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Block::where('resource_id', 'iws_hero_slider')->delete();

        BlockVariableType::where('fqn', Number::class)->delete();

        Schema::table('blocks', function (Blueprint $table) {
            $table->dropColumn('multilayered');
        });
    }
}
