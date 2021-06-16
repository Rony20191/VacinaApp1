<?php

namespace App\Repositories;

class BaseRepository
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return $this->model->all();
    }

    public function store(array $dados)
    {
        return $this->model->create($dados);
    }

    public function show(string $id)
    {
        return $this->model->findOrFail($id);
    }
}
