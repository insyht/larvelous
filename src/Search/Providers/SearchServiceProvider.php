<?php

namespace Insyht\Larvelous\Search\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Insyht\Larvelous\Search\Entities\SearchQuery;
use Insyht\Larvelous\Search\Entities\SearchResult;
use Insyht\Larvelous\Search\Interfaces\SearchInterface;
use Insyht\Larvelous\Search\Interfaces\SearchQueryInterface;
use Insyht\Larvelous\Search\Interfaces\SearchResultInterface;
use Insyht\Larvelous\Search\Services\Search;

class SearchServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(SearchInterface::class, function (Application $app) {
            return new Search();
        });
        $this->app->bind(SearchQueryInterface::class, function (Application $app) {
            return new SearchQuery();
        });
        $this->app->bind(SearchResultInterface::class, function (Application $app) {
            return new SearchResult(request());
        });
    }

    public function boot()
    {

    }
}
