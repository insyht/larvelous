<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Insyht\Larvelous\Forms\Components\Slider;
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
        $blockVariableTypeSlide = new BlockVariableType();
        $blockVariableTypeSlide->name = 'slide';
        $blockVariableTypeSlide->fqn = Slider::class;
        $blockVariableTypeSlide->save();

        // blocks
        $heroSliderBlock = new Block();
        $heroSliderBlock->resource_id = 'iws_hero_slider';
        $heroSliderBlock->view = 'blocks.hero-slider';
        $heroSliderBlock->label = 'Hero slider';
        $heroSliderBlock->description = 'A slider with slides that contain an image and an optional text block';
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

        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('block_template_id');
            $table->timestamps();
        });

        Schema::create('slides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slider_id');
            $table->text('image');
            $table->text('text');
            $table->integer('ordering')->default(0);
            $table->timestamps();
            $table->index('slider_id');
            $table->foreign('slider_id')->references('id')->on('sliders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slides');
        Schema::dropIfExists('sliders');
        BlockVariable::where('name', 'slide')->delete();
        Block::where('resource_id', 'iws_hero_slider')->delete();
        BlockVariableType::where('fqn', Slider::class)->delete();
    }
}
