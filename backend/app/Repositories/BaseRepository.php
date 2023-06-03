<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected Model $model;

    /**
     * @throws BindingResolutionException|BindingResolutionException
     */
    public function __construct()
    {
        $this->model = app()->make($this->model());
    }

    abstract public function model(): string;

    public function query(): Builder
    {
        return $this->query ?? $this->model->newQuery();
    }
}
