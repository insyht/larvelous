<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Insyht\Larvelous\Forms\Components\Dropdown;
use Insyht\Larvelous\Forms\Components\ExistingImageUpload;
use Insyht\Larvelous\Forms\Components\Textarea;
use Insyht\Larvelous\Forms\Components\TextInput;
use Insyht\Larvelous\Models\Block;
use Insyht\Larvelous\Models\BlockTemplate;
use Insyht\Larvelous\Models\BlockVariable;
use Insyht\Larvelous\Models\BlockVariableOption;
use Insyht\Larvelous\Models\BlockVariableType;
use Insyht\Larvelous\Models\Language;
use Insyht\Larvelous\Models\MenuItemType;
use Insyht\Larvelous\Models\Page;
use Insyht\Larvelous\Models\Template;

class CreateCmsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->createLarvelousStructure();

        $language = new Language();
        $language->name = 'Nederlands';
        $language->abbreviation = 'nl';
        $language->save();

        $this->createBlocks();
    }

    protected function createLarvelousStructure(): void
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
        $blockVariableTypeTextfield = new BlockVariableType();
        $blockVariableTypeTextfield->name = BlockVariableType::TYPE_TEXTFIELD;
        $blockVariableTypeTextfield->fqn = TextInput::class;
        $blockVariableTypeTextfield->save();

        $blockVariableTypeTextarea = new BlockVariableType();
        $blockVariableTypeTextarea->name = BlockVariableType::TYPE_TEXTAREA;
        $blockVariableTypeTextarea->fqn = Textarea::class;
        $blockVariableTypeTextarea->save();

        $blockVariableTypeImage = new BlockVariableType();
        $blockVariableTypeImage->name = BlockVariableType::TYPE_IMAGE;
        $blockVariableTypeImage->fqn = ExistingImageUpload::class;
        $blockVariableTypeImage->save();

        $blockVariableTypeDropdown = new BlockVariableType();
        $blockVariableTypeDropdown->name = BlockVariableType::TYPE_DROPDOWN;
        $blockVariableTypeDropdown->fqn = Dropdown::class;
        $blockVariableTypeDropdown->save();

        Schema::create('block_variables', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('block_id', false, true);
            $table->string('name', 50);
            $table->string('label', 100);
            $table->string('type', 50);
            $table->boolean('required')->unsigned();
            $table->integer('ordering')->unsigned();

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
            $table->text('value');

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
            $table->string('position')->nullable()->default(null);
            $table->bigInteger('menu_id', false, true)->nullable()->default(null);

            $table->index('language_id');
            $table->index('menu_id');
            $table->foreign('language_id')->references('id')->on('languages')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('menu_id')->references('id')->on('menus')->cascadeOnUpdate()->nullOnDelete();
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
            $table->string('classname')->default('');
            $table->string('title_column');

            $table->unique(['classname']);
        });
        $type = new MenuItemType();
        $type->classname = Page::class;
        $type->title_column = 'title';
        $type->save();

        Schema::create('plugins', function (Blueprint $table) {
            $table->id();
            $table->string('base', 50);
            $table->string('name', 50);
            $table->string('path', 50);
            $table->text('namespace');
            $table->text('github_url');
            $table->boolean('active')->default(1);
            $table->boolean('fresh_install')->default(1);
            $table->string('author', 100);
        });

        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('path', 100);
            $table->text('namespace');
            $table->text('blade_prefix');
            $table->text('github_url');
            $table->text('image')->nullable();
            $table->boolean('active')->default(1);
            $table->string('author', 100);
        });

        Schema::create('block_theme', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('block_id', false, true);
            $table->bigInteger('theme_id', false, true);
            $table->text('template_path');

            $table->unique(['block_id', 'theme_id']);
            $table->index('block_id');
            $table->index('theme_id');

            $table->foreign('block_id')->references('id')->on('blocks')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('theme_id')->references('id')->on('themes')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('value', 250);
            $table->boolean('hidden')->default(true);
            $table->index('name');
            $table->unique(['name', 'value']);
        });
    }

    protected function destroyLarvelousStructure(): void
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

    protected function createBlocks(): void
    {
        $this->createParagraphBlock();
        $this->createImageAttentionBlock();
        $this->createNewsletterBlock();
        $this->createCtaBlock();
        $this->createHeroBlock();
        $this->createLandingPage();
    }

    protected function destroyBlocks(): void
    {
        // Foreign key constraints will remove the rest automatically
        Block::where('resource_id', 'iws_landing_page_header')->delete();
        Block::where('resource_id', 'iws_hero')->delete();
        Block::where('resource_id', 'iws_cta')->delete();
        Block::where('resource_id', 'iws_newsletter')->delete();
        Block::where('resource_id', 'iws_image_attention')->delete();
        Block::where('resource_id', 'iws_paragraph')->delete();
    }

    protected function createParagraphBlock(): void
    {
        // blocks
        $paragraphBlock = new Block();
        $paragraphBlock->resource_id = 'iws_paragraph';
        $paragraphBlock->view = 'blocks.paragraph';
        $paragraphBlock->label = 'Alinea';
        $paragraphBlock->description = 'Alinea';
        $paragraphBlock->save();
        $paragraphBlock->refresh();

        // blocks_variables
        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $paragraphBlock->id;
        $blockVariable->name = 'title';
        $blockVariable->label = 'insyht-larvelous::cms.title';
        $blockVariable->type = BlockVariableType::TYPE_TEXTFIELD;
        $blockVariable->required = 1;
        $blockVariable->ordering = 1;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $paragraphBlock->id;
        $blockVariable->name = 'text';
        $blockVariable->label = 'insyht-larvelous::cms.text';
        $blockVariable->type = BlockVariableType::TYPE_TEXTAREA;
        $blockVariable->required = 2;
        $blockVariable->ordering = 2;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $paragraphBlock->id;
        $blockVariable->name = 'image';
        $blockVariable->label = 'insyht-larvelous::cms.image';
        $blockVariable->type = BlockVariableType::TYPE_IMAGE;
        $blockVariable->required = 0;
        $blockVariable->ordering = 3;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $paragraphBlock->id;
        $blockVariable->name = 'url';
        $blockVariable->label = 'insyht-larvelous::cms.url';
        $blockVariable->type = BlockVariableType::TYPE_TEXTFIELD;
        $blockVariable->required = 0;
        $blockVariable->ordering = 4;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $paragraphBlock->id;
        $blockVariable->name = 'url_text';
        $blockVariable->label = 'insyht-larvelous::cms.urlText';
        $blockVariable->type = BlockVariableType::TYPE_TEXTFIELD;
        $blockVariable->required = 0;
        $blockVariable->ordering = 5;
        $blockVariable->save();

        $imagePositionBlockVariable = new BlockVariable();
        $imagePositionBlockVariable->block_id = $paragraphBlock->id;
        $imagePositionBlockVariable->name = 'image_position';
        $imagePositionBlockVariable->label = 'insyht-larvelous::cms.imagePosition';
        $imagePositionBlockVariable->type = BlockVariableType::TYPE_DROPDOWN;
        $imagePositionBlockVariable->required = 0;
        $imagePositionBlockVariable->ordering = 6;
        $imagePositionBlockVariable->save();
        $imagePositionBlockVariable->refresh();

        // block_variable_options
        $blockVariableOption = new BlockVariableOption();
        $blockVariableOption->block_variable_id = $imagePositionBlockVariable->id;
        $blockVariableOption->label = 'insyht-larvelous::cms.links';
        $blockVariableOption->value = 'left';
        $blockVariableOption->save();
        $blockVariableOption = new BlockVariableOption();
        $blockVariableOption->block_variable_id = $imagePositionBlockVariable->id;
        $blockVariableOption->label = 'insyht-larvelous::cms.right';
        $blockVariableOption->value = 'right';
        $blockVariableOption->save();
    }

    protected function createImageAttentionBlock(): void
    {
        // blocks
        $imageAttentionBlock = new Block();
        $imageAttentionBlock->resource_id = 'iws_image_attention';
        $imageAttentionBlock->view = 'blocks.image_attention';
        $imageAttentionBlock->label = 'ImageAttention';
        $imageAttentionBlock->description = 'Afbeeldingen aandachtstrekker';
        $imageAttentionBlock->save();
        $imageAttentionBlock->refresh();

        // blocks_variables
        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $imageAttentionBlock->id;
        $blockVariable->name = 'image_left';
        $blockVariable->label = 'insyht-larvelous::cms.leftImage';
        $blockVariable->type = BlockVariableType::TYPE_IMAGE;
        $blockVariable->required = 1;
        $blockVariable->ordering = 1;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $imageAttentionBlock->id;
        $blockVariable->name = 'image_right_top';
        $blockVariable->label = 'insyht-larvelous::cms.imageRightTop';
        $blockVariable->type = BlockVariableType::TYPE_IMAGE;
        $blockVariable->required = 1;
        $blockVariable->ordering = 2;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $imageAttentionBlock->id;
        $blockVariable->name = 'image_right_bottom';
        $blockVariable->label = 'insyht-larvelous::cms.imageRightBottom';
        $blockVariable->type = BlockVariableType::TYPE_IMAGE;
        $blockVariable->required = 1;
        $blockVariable->ordering = 3;
        $blockVariable->save();
    }

    protected function createNewsletterBlock(): void
    {
        // blocks
        $newsletterBlock = new Block();
        $newsletterBlock->resource_id = 'iws_newsletter';
        $newsletterBlock->view = 'blocks.newsletter';
        $newsletterBlock->label = 'Newsletter';
        $newsletterBlock->description = 'Nieuwsbrief';
        $newsletterBlock->save();
        $newsletterBlock->refresh();

        // blocks_variables
        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $newsletterBlock->id;
        $blockVariable->name = 'image_left';
        $blockVariable->label = 'insyht-larvelous::cms.leftImage';
        $blockVariable->type = BlockVariableType::TYPE_IMAGE;
        $blockVariable->required = 0;
        $blockVariable->ordering = 1;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $newsletterBlock->id;
        $blockVariable->name = 'image_right';
        $blockVariable->label = 'insyht-larvelous::cms.rightImage';
        $blockVariable->type = BlockVariableType::TYPE_IMAGE;
        $blockVariable->required = 0;
        $blockVariable->ordering = 2;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $newsletterBlock->id;
        $blockVariable->name = 'text';
        $blockVariable->label = 'insyht-larvelous::cms.text';
        $blockVariable->type = BlockVariableType::TYPE_TEXTAREA;
        $blockVariable->required = 1;
        $blockVariable->ordering = 3;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $newsletterBlock->id;
        $blockVariable->name = 'title';
        $blockVariable->label = 'insyht-larvelous::cms.title';
        $blockVariable->type = BlockVariableType::TYPE_TEXTFIELD;
        $blockVariable->required = 1;
        $blockVariable->ordering = 4;
        $blockVariable->save();
    }

    protected function createCtaBlock(): void
    {
        // blocks
        $ctaBlock = new Block();
        $ctaBlock->resource_id = 'iws_cta';
        $ctaBlock->view = 'blocks.cta';
        $ctaBlock->label = 'Call to action';
        $ctaBlock->description = 'Call to action';
        $ctaBlock->save();
        $ctaBlock->refresh();

        // blocks_variables
        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $ctaBlock->id;
        $blockVariable->name = 'email';
        $blockVariable->label = 'insyht-larvelous::cms.emailAddress';
        $blockVariable->type = BlockVariableType::TYPE_TEXTFIELD;
        $blockVariable->required = 0;
        $blockVariable->ordering = 7;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $ctaBlock->id;
        $blockVariable->name = 'function';
        $blockVariable->label = 'insyht-larvelous::cms.function';
        $blockVariable->type = BlockVariableType::TYPE_TEXTFIELD;
        $blockVariable->required = 0;
        $blockVariable->ordering = 5;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $ctaBlock->id;
        $blockVariable->name = 'image';
        $blockVariable->label = 'insyht-larvelous::cms.image';
        $blockVariable->type = BlockVariableType::TYPE_IMAGE;
        $blockVariable->required = 1;
        $blockVariable->ordering = 3;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $ctaBlock->id;
        $blockVariable->name = 'name';
        $blockVariable->label = 'insyht-larvelous::cms.name';
        $blockVariable->type = BlockVariableType::TYPE_TEXTFIELD;
        $blockVariable->required = 1;
        $blockVariable->ordering = 4;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $ctaBlock->id;
        $blockVariable->name = 'phone_number';
        $blockVariable->label = 'insyht-larvelous::cms.phoneNumber';
        $blockVariable->type = BlockVariableType::TYPE_TEXTFIELD;
        $blockVariable->required = 1;
        $blockVariable->ordering = 6;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $ctaBlock->id;
        $blockVariable->name = 'text';
        $blockVariable->label = 'insyht-larvelous::cms.text';
        $blockVariable->type = BlockVariableType::TYPE_TEXTAREA;
        $blockVariable->required = 1;
        $blockVariable->ordering = 2;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $ctaBlock->id;
        $blockVariable->name = 'title';
        $blockVariable->label = 'insyht-larvelous::cms.title';
        $blockVariable->type = BlockVariableType::TYPE_TEXTFIELD;
        $blockVariable->required = 1;
        $blockVariable->ordering = 1;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $ctaBlock->id;
        $blockVariable->name = 'url';
        $blockVariable->label = 'insyht-larvelous::cms.url';
        $blockVariable->type = BlockVariableType::TYPE_TEXTFIELD;
        $blockVariable->required = 1;
        $blockVariable->ordering = 8;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $ctaBlock->id;
        $blockVariable->name = 'url_text';
        $blockVariable->label = 'insyht-larvelous::cms.urlText';
        $blockVariable->type = BlockVariableType::TYPE_TEXTFIELD;
        $blockVariable->required = 1;
        $blockVariable->ordering = 9;
        $blockVariable->save();
    }

    protected function createHeroBlock(): void
    {
        // blocks
        $heroImageBlock = new Block();
        $heroImageBlock->resource_id = 'iws_hero';
        $heroImageBlock->view = 'blocks.hero';
        $heroImageBlock->label = 'Hero';
        $heroImageBlock->description = 'A large image with some text below it, usually at the top of the page';
        $heroImageBlock->save();
        $heroImageBlock->refresh();

        // blocks_variables
        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $heroImageBlock->id;
        $blockVariable->name = 'image';
        $blockVariable->label = 'insyht-larvelous::cms.image';
        $blockVariable->type = BlockVariableType::TYPE_IMAGE;
        $blockVariable->required = 1;
        $blockVariable->ordering = 1;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $heroImageBlock->id;
        $blockVariable->name = 'text';
        $blockVariable->label = 'insyht-larvelous::cms.text';
        $blockVariable->type = BlockVariableType::TYPE_TEXTAREA;
        $blockVariable->required = 0;
        $blockVariable->ordering = 2;
        $blockVariable->save();
    }

    protected function createLandingPage(): void
    {
        $template = new Template();
        $template->resource_id = 'iws_landing_page';
        $template->label = 'Landing page template';
        $template->view = 'landingpage';
        $template->save();
        $template->refresh();

        $page = new Page();
        $page->language_id = Language::where('name', 'Nederlands')->first()->id;
        $page->template_id = $template->id;
        $page->title = 'Landingspagina';
        $page->url = 'landingspagina';
        $page->save();

        // Header block
        $landingPageHeaderBlock = new Block();
        $landingPageHeaderBlock->resource_id = 'iws_landing_page_header';
        $landingPageHeaderBlock->view = 'blocks.landing_page_header';
        $landingPageHeaderBlock->label = 'Landing page header';
        $landingPageHeaderBlock->description = 'A header with a title, subtitle, text, quote, link button and background image';
        $landingPageHeaderBlock->save();
        $landingPageHeaderBlock->refresh();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $landingPageHeaderBlock->id;
        $blockVariable->name = 'title';
        $blockVariable->label = 'insyht-larvelous::cms.title';
        $blockVariable->type = BlockVariableType::TYPE_TEXTFIELD;
        $blockVariable->required = 1;
        $blockVariable->ordering = 1;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $landingPageHeaderBlock->id;
        $blockVariable->name = 'subtitle';
        $blockVariable->label = 'insyht-larvelous::cms.subtitle';
        $blockVariable->type = BlockVariableType::TYPE_TEXTFIELD;
        $blockVariable->required = 1;
        $blockVariable->ordering = 2;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $landingPageHeaderBlock->id;
        $blockVariable->name = 'text';
        $blockVariable->label = 'insyht-larvelous::cms.text';
        $blockVariable->type = BlockVariableType::TYPE_TEXTAREA;
        $blockVariable->required = 1;
        $blockVariable->ordering = 3;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $landingPageHeaderBlock->id;
        $blockVariable->name = 'quote';
        $blockVariable->label = 'insyht-larvelous::cms.quote';
        $blockVariable->type = BlockVariableType::TYPE_TEXTAREA;
        $blockVariable->required = 0;
        $blockVariable->ordering = 4;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $landingPageHeaderBlock->id;
        $blockVariable->name = 'quote_name';
        $blockVariable->label = 'insyht-larvelous::cms.name';
        $blockVariable->type = BlockVariableType::TYPE_TEXTFIELD;
        $blockVariable->required = 0;
        $blockVariable->ordering = 5;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $landingPageHeaderBlock->id;
        $blockVariable->name = 'quote_city';
        $blockVariable->label = 'insyht-larvelous::cms.city';
        $blockVariable->type = BlockVariableType::TYPE_TEXTFIELD;
        $blockVariable->required = 0;
        $blockVariable->ordering = 6;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $landingPageHeaderBlock->id;
        $blockVariable->name = 'url';
        $blockVariable->label = 'insyht-larvelous::cms.url';
        $blockVariable->type = BlockVariableType::TYPE_TEXTFIELD;
        $blockVariable->required = 0;
        $blockVariable->ordering = 7;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $landingPageHeaderBlock->id;
        $blockVariable->name = 'url_text';
        $blockVariable->label = 'insyht-larvelous::cms.urlText';
        $blockVariable->type = BlockVariableType::TYPE_TEXTFIELD;
        $blockVariable->required = 0;
        $blockVariable->ordering = 8;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $landingPageHeaderBlock->id;
        $blockVariable->name = 'image';
        $blockVariable->label = 'insyht-larvelous::cms.image';
        $blockVariable->type = BlockVariableType::TYPE_IMAGE;
        $blockVariable->required = 0;
        $blockVariable->ordering = 9;
        $blockVariable->save();

        // Image tetralogy block
        $tetralogyBlock = new Block();
        $tetralogyBlock->resource_id = 'iws_image_tetralogy';
        $tetralogyBlock->view = 'blocks.image_tetralogy';
        $tetralogyBlock->label = 'Image Tetralogy';
        $tetralogyBlock->description = 'A title with four images';
        $tetralogyBlock->save();
        $tetralogyBlock->refresh();

        $variable = new BlockVariable();
        $variable->block_id = $tetralogyBlock->id;
        $variable->name = 'title';
        $variable->label = 'insyht-larvelous::cms.title';
        $variable->type = BlockVariableType::TYPE_TEXTFIELD;
        $variable->required = 1;
        $variable->ordering = 1;
        $variable->save();

        for ($i = 2; $i <= 5; $i++) {
            $blockVariable = new BlockVariable();
            $blockVariable->block_id = $tetralogyBlock->id;
            $blockVariable->name = 'image';
            $blockVariable->label = 'insyht-larvelous::cms.image';
            $blockVariable->type = BlockVariableType::TYPE_IMAGE;
            $blockVariable->required = 1;
            $blockVariable->ordering = $i;
            $blockVariable->save();
        }

        // Title+text block
        $titleTextBlock = new Block();
        $titleTextBlock->resource_id = 'iws_title_text';
        $titleTextBlock->view = 'blocks.title_text';
        $titleTextBlock->label = 'Title + text';
        $titleTextBlock->description = 'Title and a text';
        $titleTextBlock->save();
        $titleTextBlock->refresh();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $titleTextBlock->id;
        $blockVariable->name = 'title';
        $blockVariable->label = 'insyht-larvelous::cms.title';
        $blockVariable->type = BlockVariableType::TYPE_TEXTFIELD;
        $blockVariable->required = 1;
        $blockVariable->ordering = 1;
        $blockVariable->save();

        $blockVariable = new BlockVariable();
        $blockVariable->block_id = $titleTextBlock->id;
        $blockVariable->name = 'text';
        $blockVariable->label = 'insyht-larvelous::cms.text';
        $blockVariable->type = BlockVariableType::TYPE_TEXTAREA;
        $blockVariable->required = 1;
        $blockVariable->ordering = 2;
        $blockVariable->save();

        $uspsBlock = new Block();
        $uspsBlock->resource_id = 'iws_usps';
        $uspsBlock->view = 'blocks.usps';
        $uspsBlock->label = 'USPs';
        $uspsBlock->description = 'Three USPs';
        $uspsBlock->save();
        $uspsBlock->refresh();

        for ($i = 1; $i <= 3; $i++) {
            $blockVariable = new BlockVariable();
            $blockVariable->block_id = $uspsBlock->id;
            $blockVariable->name = 'icon';
            $blockVariable->label = 'insyht-larvelous::cms.icon';
            $blockVariable->type = BlockVariableType::TYPE_TEXTFIELD;
            $blockVariable->required = 1;
            $blockVariable->ordering = (($i - 1) * 3) + 1;
            $blockVariable->save();

            $blockVariable = new BlockVariable();
            $blockVariable->block_id = $uspsBlock->id;
            $blockVariable->name = 'title';
            $blockVariable->label = 'insyht-larvelous::cms.title';
            $blockVariable->type = BlockVariableType::TYPE_TEXTFIELD;
            $blockVariable->required = 1;
            $blockVariable->ordering = (($i - 1) * 3) + 2;
            $blockVariable->save();

            $blockVariable = new BlockVariable();
            $blockVariable->block_id = $uspsBlock->id;
            $blockVariable->name = 'text';
            $blockVariable->label = 'insyht-larvelous::cms.text';
            $blockVariable->type = BlockVariableType::TYPE_TEXTFIELD;
            $blockVariable->required = 1;
            $blockVariable->ordering = (($i - 1) * 3) + 3;
            $blockVariable->save();
        }

        // Link blocks to template
        $blockTemplate = new BlockTemplate();
        $blockTemplate->template_id = $template->id;
        $blockTemplate->block_id = $landingPageHeaderBlock->id;
        $blockTemplate->enabled = 1;
        $blockTemplate->ordering = 1;
        $blockTemplate->save();

        $blockTemplate = new BlockTemplate();
        $blockTemplate->template_id = $template->id;
        $blockTemplate->block_id = $tetralogyBlock->id;
        $blockTemplate->enabled = 1;
        $blockTemplate->ordering = 2;
        $blockTemplate->save();

        $blockTemplate = new BlockTemplate();
        $blockTemplate->template_id = $template->id;
        $blockTemplate->block_id = $titleTextBlock->id;
        $blockTemplate->enabled = 1;
        $blockTemplate->ordering = 3;
        $blockTemplate->save();

        $blockTemplate = new BlockTemplate();
        $blockTemplate->template_id = $template->id;
        $blockTemplate->block_id = $uspsBlock->id;
        $blockTemplate->enabled = 1;
        $blockTemplate->ordering = 4;
        $blockTemplate->save();

        $paragraphBlock = Block::where('resource_id', 'iws_paragraph')->first();
        for ($i = 6; $i <= 9; $i++) {
            $blockTemplate = new BlockTemplate();
            $blockTemplate->template_id = $template->id;
            $blockTemplate->block_id = $paragraphBlock->id;
            $blockTemplate->enabled = 1;
            $blockTemplate->ordering = $i;
            $blockTemplate->save();
        }

        $blockTemplate = new BlockTemplate();
        $blockTemplate->template_id = $template->id;
        $blockTemplate->block_id = Block::where('resource_id', 'iws_cta')->first()->id;
        $blockTemplate->enabled = 1;
        $blockTemplate->ordering = 10;
        $blockTemplate->save();
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plugins');
        $this->destroyBlocks();
        $this->destroyLarvelousStructure();
    }
}
