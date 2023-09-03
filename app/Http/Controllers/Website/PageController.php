<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function load(Page $page)
    {
        if ($page->id === null) {
            $page = Page::where('url', '')->first();
            if ($page === null) {
                App::abort(404);
            }
        }

        // Check if all required views actually exist before loading the page. If not, show a 404 page
        foreach ($page->template->blocks()->get() as $block) {
            if (!view()->exists($block->view)) {
                Log::warning(
                    sprintf(
                        'Failed to find view "%s" for block "%s" on page "%s" (block id: %d)',
                        $block->view,
                        $block->resource_id,
                        $page->title,
                        $block->id
                    )
                );
                App::abort(404);
            }
        }

        return view($page->template->view, ['page' => $page]);
    }
}
