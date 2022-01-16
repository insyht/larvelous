<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Support\Facades\App;

class PageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function load(string $pageName)
    {
        $page = Page::where('url', $pageName)->first();
        if ($page === null) {
            // 404
            App::abort(404);
        }

        $template = $page->template->blade_template;
        $templateName = $this->getTemplateName($template);
        if ($templateName === null) {
            App::abort(404);
        }

//        $template = $page->template;
//        $block = $template->blocks()->first();
//        $blockVariable = $block->blockvariables->first();
//        $blockVariableValue = $blockVariable->blockVariableValues->first();
//        $blockVariableValueTemplateBlock = $blockVariableValue->blockVariableValueTemplateBlocks->first();
//        $pageBlocks = $page->template->blocks->all();

//
//        $results = DB::select('
//            SELECT
//                   t.resource_id AS template_resource_id,
//                   b.resource_id AS block_resource_id,
//                   bv.name,
//                   bvv.value,
//                   bt.ordering AS block_template_ordering,
//                   bvvtb.ordering AS value_ordering
//            FROM pages p
//            INNER JOIN templates t ON t.id = p.template_id
//            INNER JOIN block_template bt ON bt.template_id = t.id
//            INNER JOIN blocks b ON b.id = bt.block_id
//            INNER JOIN block_variables bv ON bv.block_id = b.id
//            INNER JOIN block_variable_values bvv ON bvv.block_variable_id = bv.id
//            INNER JOIN block_variable_value_template_blocks bvvtb ON bvvtb.block_variable_value_id = bvv.id AND bvvtb.template_block_id = bt.id
//            WHERE p.id = 3 AND p.language_id = 3
//            ORDER BY bt.ordering, bvvtb.ordering;');
//
//        foreach ($results as $result) {
//            if (!array_key_exists($result->template_resource_id, $data)) {
//                $data[$result->template_resource_id] = [];
//            }
//            if (!array_key_exists($result->block_resource_id, $data[$result->template_resource_id])) {
//                $data[$result->template_resource_id][$result->block_resource_id] = [];
//            }
//            $data[$result->template_resource_id][$result->block_resource_id][$result->value_ordering] = [
//                'name' => $result->name,
//                'value' => $result->value,
//            ];
//        }

        return view(
            $templateName,
            ['data' => Page::where('title', 'home')->first()]
        );
    }

    protected function getTemplateName(string $template): ?string
    {
        if (!view()->exists($template)) {
            // View not found yet, let's try to fix that
            if (strpos($template, '/') !== false) {
                // This is a filesystem path instead of a Laravel path. Convert it to a Laravel path
                $templatePathArray = explode('/', $template);
                $templateName = array_pop($templatePathArray);
                $templatePath = implode('/', $templatePathArray);
                $path = realpath(__DIR__ . '/../../../../' . $templatePath);
                if ($path !== false) {
                    // Path exists
                    if (substr($templateName, -10, 10) === '.blade.php') {
                        // Remove the .blade.php part from the template name
                        $templateName = substr($templateName, 0, -10);
                    }
                    if (!view()->exists($templateName)) {
                        // Add the path to the list of paths where Laravel searches for Blade templates
                        view()->addLocation(__DIR__ . '/../../../../' . $templatePath);
                    }
                    if (!view()->exists($templateName)) {
                        // Too bad, after all our trouble it still cannot find the template. Abort.
                        $templateName = null;
                    }
                } else {
                    // Path not found, abort
                    $templateName = null;
                }
            } else {
                // Can't figure out where the template is, abort
                $templateName = null;
            }
        } else {
            // Template found
            $templateName = $template;
        }

        return $templateName;
    }
}
