<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Plugin;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function load(string $pageName = '')
    {
        $page = Page::where('url', $pageName)->first();
        if ($page === null) {
            $view = $this->loadFromPlugins($pageName);
            if ($view !== null) {
                return $view;
            }

            App::abort(404);
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

    protected function loadFromPlugins(string $slug)
    {
        $view = null;
        foreach (Plugin::all() as $plugin) {
            /** @var Plugin $plugin  */
            if (file_exists($plugin->getFullPath() . '/Controllers/BaseController.php')) {
                require_once $plugin->getFullPath() . '/Controllers/BaseController.php';
                $fqn = $plugin->namespace . '\Controllers\BaseController';
                if (class_exists($fqn) && method_exists($fqn, 'match')) {
                    $controller = new $fqn();
                    $match = $controller->match($slug);
                    if ($match && method_exists($fqn, 'load')) {
                        $view = $controller->load($slug);
                        break;
                    }
                }
            }
        }

        return $view;
    }
}
