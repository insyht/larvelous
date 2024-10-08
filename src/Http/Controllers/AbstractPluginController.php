<?php

namespace Insyht\Larvelous\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use ReflectionClass;

abstract class AbstractPluginController extends Controller
{
    protected function getPluginViewPath(): string
    {
        return $this->getPluginPath('.') . '.resources.views';
    }

    protected function getPluginPath(string $separator = '/', bool $fullPath = false): string
    {
        // Full path to the plugin controller from where this method is called
        $fullControllerPath = dirname((new ReflectionClass($this))->getFileName());
        $explode = explode('/', $fullControllerPath);
        // Find the key where the value is 'vendor'
        $splitKey = array_search('vendor', $explode) + 1;
        if ($fullPath) {
            $splitKey = array_search('vendor', $explode) - 1;
        }
        // Remove the path up until vendor/
        $relativePathArray = array_slice($explode, $splitKey);
        // Remove "Controller" directory
        array_pop($relativePathArray);
        $relativePath = implode($separator, $relativePathArray);

        return $relativePath;
    }

    protected function decoratedView(string $template, array $additionalVariables = []): View
    {
        $view = view($template)->with('templatePath', $this->getPluginViewPath());

        foreach ($additionalVariables as $name => $data) {
            $view->with($name, $data);
        }

        return $view;
    }

    protected function paginateCollection(Collection $collection, int $perPage = 10): LengthAwarePaginator
    {
        $page = LengthAwarePaginator::resolveCurrentPage();

        return new LengthAwarePaginator(
            $collection->forPage($page, $perPage)->values(),
            $collection->count(),
            $perPage,
            $page,
            [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
                'pageName' => 'page',
            ]
        );
    }
}
