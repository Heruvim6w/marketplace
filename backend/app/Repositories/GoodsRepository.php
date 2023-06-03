<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Filters\Brand;
use App\Filters\Category;
use App\Filters\Description;
use App\Filters\Name;
use App\Filters\Property;
use App\Filters\Proposal;
use App\Models\Goods;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pipeline\Pipeline;

class GoodsRepository extends BaseRepository
{
    public function model(): string
    {
        return Goods::class;
    }

    public function index(): LengthAwarePaginator
    {
        $goods = app(Pipeline::class)
            ->send($this->query()->with(['categories', 'properties']))
            ->through($this->filters())
            ->thenReturn()
            ->select('*')
            ->distinct();

        return $goods->orderBy('id')->paginate();
    }

    private function filters(): array
    {
        return [
            Name::class,
            Description::class,
            Brand::class,
            Category::class,
            Property::class,
            //ToDo
//            Proposal::class,
        ];
    }
}
