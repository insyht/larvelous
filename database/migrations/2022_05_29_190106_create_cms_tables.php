<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCmsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->string('resource_id', 100);
            $table->string('view', 100);
            $table->string('label', 100);
            $table->string('description', 250);
        });

        Schema::create('block_variable_types', function (Blueprint $table) {
            $table->string('name', 50)->primary();
            $table->text('fqn');
        });

        Schema::create('block_variables', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('block_id', false, true);
            $table->string('name', 50);
            $table->string('label', 100);
            $table->string('type', 50);
            $table->boolean('required')->unsigned();
            $table->integer('required')->unsigned();

            $table->unique(['block_id', 'name', 'ordering']);
            $table->index('block_id');

            $table->foreign('block_id')->references('id')->on('blocks')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('type')->references('name')->on('block_variable_types')->onUpdate('cascade')->onDelete('restrict');
        });

        Schema::create('block_variable_options', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('block_variable_id', false, true);
            $table->string('label', 200);
            $table->text('value');

            $table->index('block_variable_id');

            $table->foreign('block_variable_id')
                  ->references('id')
                  ->on('block_variables')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });

        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->nullable();
            $table->string('abbreviation', 2);
        });

        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string('resource_id', 100);
            $table->string('label', 100);
            $table->string('view', 100);
        });

        Schema::create('block_template', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('template_id', false, true);
            $table->bigInteger('block_id', false, true);
            $table->boolean('enabled')->unsigned();
            $table->integer('ordering')->default(0)->unsigned();

            $table->index('block_id');
            $table->index('template_id');

            $table->foreign('template_id')->references('id')->on('templates')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('block_id')->references('id')->on('blocks')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('language_id', false, true);
            $table->bigInteger('template_id', false, true);
            $table->string('title', 100);
            $table->string('url', 250);

            $table->index('language_id');
            $table->index('template_id');

            $table->foreign('language_id')->references('id')->on('languages')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('template_id')->references('id')->on('templates')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('block_variable_values', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('block_variable_id', false, true);
            $table->bigInteger('language_id', false, true);
            $table->bigInteger('page_id', false, true);
            $table->bigInteger('block_template_id', false, true);
            $table->text('value')->default('');

            $table->index('block_variable_id');
            $table->index('language_id');
            $table->index('page_id');
            $table->index('block_template_id');

            $table->foreign('block_variable_id')
                  ->references('id')
                  ->on('block_variables')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            $table->foreign('language_id')->references('id')->on('languages')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('page_id')->references('id')->on('pages')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('block_template_id')
                  ->references('id')
                  ->on('block_template')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
        });

        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('language_id', false, true);
            $table->string('name');
            $table->string('position');

            $table->index('language_id');
            $table->foreign('language_id')->references('id')->on('languages')->cascadeOnUpdate()->cascadeOnDelete();
        });

        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('menu_id', false, true);
            $table->bigInteger('item_id', false, true);
            $table->string('item_type');
            $table->integer('ordering')->unsigned();
            $table->timestamps();

            $table->unique(['menu_id', 'item_id', 'item_type']);
            $table->index('menu_id');
            $table->index('item_id');

            $table->foreign('menu_id')->references('id')->on('menus')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('menu_item_types', function (Blueprint $table) {
            $table->id();
            $table->string('classname');
            $table->string('title_column');

            $table->unique(['classname']);
        });
        $type = new \App\Models\MenuItemType();
        $type->classname = '\App\Models\Page::class';
        $type->title_column = 'title';
        $type->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('menu_item_types');
        Schema::dropIfExists('menu_items');
        Schema::dropIfExists('menus');
        Schema::dropIfExists('block_variable_value_template_blocks');
        Schema::dropIfExists('block_variable_values');
        Schema::dropIfExists('block_template');
        Schema::dropIfExists('templates');
        Schema::dropIfExists('languages');
        Schema::dropIfExists('block_variable_options');
        Schema::dropIfExists('block_variables');
        Schema::dropIfExists('blocks');
        Schema::dropIfExists('pages');

        // todo remove next line
        DB::table('migrations')->truncate();

        Schema::enableForeignKeyConstraints();
    }
}
