<?php

namespace Insyht\Larvelous\Http\Controllers\Website;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Insyht\Larvelous\Search\Collections\SearchResultCollection;
use Insyht\Larvelous\Search\Interfaces\SearchInterface;
use Insyht\Larvelous\Search\Interfaces\SearchQueryInterface;

class SearchController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');
        $results = [];

        if (!empty($query)) {
            $searchQuery = app(SearchQueryInterface::class)->fromString($query);
            $searcher = app(SearchInterface::class);
            $results = new SearchResultCollection();
            foreach ($searcher->getSearchables() as $searchable) {
                $results = $results->merge($searchable->search($searchQuery));
            }
        }

        // Group results by url
        $groupedResults = [];
        foreach ($results as $result) {
            if (!isset($groupedResults[$result->getUrl()])) {
                $groupedResults[$result->getUrl()] = [
                    'url' => $result->getUrl(),
                    'title' => $result->getTitle(),
                    'results' => [],
                ];
            }
            $groupedResults[$result->getUrl()]['results'][] = $result;
        }
        // Group by amount of results per url, descending
        usort($groupedResults, function (array $groupedResult1, array $groupedResult2) {
            return count($groupedResult2['results']) <=> count($groupedResult1['results']);
        });
        // Add results count to title per url
        array_walk(
            $groupedResults,
            function (array &$groupedResult) {
                $groupedResult['title'] = $groupedResult['title']  . sprintf(' (%d)', count($groupedResult['results']));

                return $groupedResult;
            }
        );

        return view('insyht-larvelous::layouts.search_results', ['searchQuery' => $query, 'results' => $groupedResults]);
    }
}
