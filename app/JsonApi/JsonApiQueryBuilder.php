<?php

namespace App\JsonApi;

use Closure;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpException;

class JsonApiQueryBuilder
{
    public function allowedSorts(): Closure
    {
        return function ($allowedSorts) {
            /** @var Builder $this*/
            if (request()->filled('sort')) {
                $sortFields = explode(',', request()->input('sort'));

                foreach ($sortFields as $sortField) {
                    $sortDirection = Str::of($sortField)->startsWith('-') ? 'desc' : 'asc';

                    $sortField = ltrim($sortField, '-');

                    if (!in_array($sortField, $allowedSorts)) {
                        throw new HttpException(400, 'HTTP 400 Bad Request');
                    }
                    $this->orderBy($sortField, $sortDirection);
                }
            }

            return $this;
        };
    }

    public function jsonPaginate(): Closure
    {
        return function(){
            /** @var Builder $this*/
            return $this->paginate(
                $perPage = request('page.size', 15),
                $columns = ['*'],
                $pageName = 'page[number]',
                $page = request('page.number', 1)
            )->appends(request()->only('sort','page.size'));
        };
    }
}
