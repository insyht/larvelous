<?php

namespace Insyht\Larvelous\Search\Interfaces;

use Illuminate\Http\Request;

interface SearchResultInterface
{
    public function __construct(Request $request);
    public function getTitle(): string;
    public function getDescription(): string;
    public function getUrl(): string;
    public function setTitle(string $title): SearchResultInterface;
    public function setDescription(string $description): SearchResultInterface;
    public function setUrl(string $url): SearchResultInterface;
}
