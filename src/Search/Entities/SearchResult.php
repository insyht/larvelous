<?php

namespace Insyht\Larvelous\Search\Entities;

use Illuminate\Http\Request;
use Insyht\Larvelous\Search\Interfaces\SearchResultInterface;

class SearchResult implements SearchResultInterface
{
    private string $title = '';
    private string $description = '';
    private string $url = '';
    private array $queries = [];

    public function __construct(Request $request)
    {
        $queryString = $request->get('q', '');
        $this->queries = explode(' ', $queryString);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;

    }

    public function getUrl(): string
    {
        return $this->url;

    }

    public function setTitle(string $title): SearchResultInterface
    {
        $this->title = $title;

        return $this;
    }

    public function setDescription(string $description): SearchResultInterface
    {
        $quoteLengthBeforeAfter = 30;
        $snippets = [];
        $x = 0;
        foreach ($this->queries as $query) {
            while (stripos($description, $query) !== false) {
                $x++;
                if ($x >= 1000) {
                    break;
                }
                $position = stripos($description, $query);
                $startPosition = ($position - $quoteLengthBeforeAfter) < 0 ? 0 : $position - $quoteLengthBeforeAfter;
                $totalLength = strlen($query) + 2 * $quoteLengthBeforeAfter;
                $snippet = str_ireplace(
                    $query,
                    '<strong>' . $query . '</strong>',
                    substr($description, $startPosition, $totalLength)
                );
                $snippets[] = '...' . $snippet . '...';
                $description = substr($description, $position + strlen($query));
            }
        }

        $this->description = implode('...<br />', $snippets);

        return $this;
    }

    public function setUrl(string $url): SearchResultInterface
    {
        $this->url = $url;

        return $this;
    }
}
