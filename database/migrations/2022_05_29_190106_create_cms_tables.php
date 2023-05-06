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

        Schema::create('block_variables', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('block_id', false, true);
            $table->string('name', 50);
            $table->string('label', 100);
            $table->string('type', 50);
            $table->boolean('required')->unsigned();

            $table->unique(['block_id', 'name']);
            $table->index('block_id');

            $table->foreign('block_id')->references('id')->on('blocks')->onUpdate('cascade')->onDelete('cascade');
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
            $table->text('value');

            $table->index('block_variable_id');
            $table->index('language_id');

            $table->foreign('block_variable_id')
                  ->references('id')
                  ->on('block_variables')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            $table->foreign('language_id')->references('id')->on('languages')->cascadeOnUpdate()->cascadeOnDelete();
        });

        Schema::create('block_variable_value_template_blocks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('template_block_id', false, true);
            $table->bigInteger('block_variable_value_id', false, true);
            $table->integer('ordering', false, true)->default(1);

            $table->unique('block_variable_value_id', 'bvvtbbvviu');
            $table->index('template_block_id');
            $table->index('block_variable_value_id', 'bvvtbbvvii');

            $table->foreign('template_block_id')
                  ->references('id')
                  ->on('block_template')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            $table->foreign('block_variable_value_id', 'bvvtbbvvif')
                  ->references('id')
                  ->on('block_variable_values')
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

        Schema::create('menu_page', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('menu_id', false, true);
            $table->bigInteger('page_id', false, true);
            $table->integer('ordering')->unsigned();

            $table->unique(['menu_id', 'page_id']);
            $table->index('menu_id');
            $table->index('page_id');

            $table->foreign('menu_id')->references('id')->on('menus')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('page_id')->references('id')->on('pages')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('menu_page');
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
