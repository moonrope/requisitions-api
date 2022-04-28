<?php

namespace Src\App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    private Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getQueryBuilder(): Builder{
        return $this->model->newQuery();
    }

    public function exists(int $id): bool
    {
        return $this->getQueryBuilder()->where('id', $id)->exists();
    }

    public function getAll(): Collection|array
    {
        return $this->getQueryBuilder()->get();
    }

    public function store(array $values): Model
    {
        return $this->getQueryBuilder()->create($values);
    }

    public function update(int $id, array $values): int
    {
        return $this->getQueryBuilder()->where('id', $id)->update($values);
    }

    public function getById(int $id): Model
    {
        return $this->getQueryBuilder()->where('id', $id)->first();
    }

    public function getByUuid(string $uuid, string $columnName = 'uuid'): Model
    {
        return $this->getQueryBuilder()->where($columnName, $uuid)->first();
    }

    public function delete(int $id): int
    {
        return $this->getQueryBuilder()->where('id', $id)->delete();
    }
}
