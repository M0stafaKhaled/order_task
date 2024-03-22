<?php

namespace App\Traits;
use Illuminate\Database\Eloquent\Builder;
trait PaginationTrait
{
    protected function pagination(Builder $query, string $modelName, array $hidden = [], int $pageSize = 10): array
    {
        $page = request()->input('page', 1);
        $totalItems = $query->count();
        $items = $query->skip(($page - 1) * $pageSize)->take($pageSize)->get();

        $items->makeHidden($hidden);

        $totalPages = ceil($totalItems / $pageSize);

        return [
            $modelName => $items,
            'pagination' => [
                'total_items' => $totalItems,
                'total_pages' => $totalPages,
                'current_page' => (int) $page,
                'page_size' => $pageSize,
            ],
        ];
    }
}
