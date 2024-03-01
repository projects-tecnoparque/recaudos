<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpKernel\Exception\HttpException;

class JsonApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('allowedSorts', function ($allowedSorts) {

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
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
