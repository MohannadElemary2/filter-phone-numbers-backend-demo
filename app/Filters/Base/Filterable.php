<?php

namespace App\Filters\Base;

use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    /**
     * Apply all relevant filters.
     *
     * @param Builder $query
     * @param Filter $filter
     * @param null $request
     * @return Builder
     */
    public function scopeFilter(
        Builder $query,
        Filter $filter,
        $request = null
    ): Builder {
        return $filter->apply($query, $request);
    }
}
