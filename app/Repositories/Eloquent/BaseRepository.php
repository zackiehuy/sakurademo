<?php


namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\IBase;

abstract class BaseRepository implements IBase
{
    protected $model;
    public function __construct()
    {
        $this->model = $this->getModelClass();
    }

    protected function getModelClass()
    {
        if (!method_exists($this, 'model')) {
            throw new ModelNotDefined();
        }
        return app()->make($this->model());
    }

    public function all()
    {
        return $this->model->get();
    }

    public function datatable()
    {
        $query = $this->model->orderBy('id', 'DESC')->get();
        return datatables()->of($query)->addIndexColumn()->make(true);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function getWhere($column, $operator, $value)
    {
        return $this->model->where($column, $operator, $value)->get();
    }

    public function getWhereFirst($column, $operator, $value)
    {
        return $this->model->where($column, $operator, $value)->firstOrFail();
    }

    public function pagination($perPage)
    {
        return $this->model->paginate($perPage);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $record = $this->find($id);
        return $record->update($data);
    }

    public function delete($id)
    {
        $record= $this->find($id);
        return $record->delete();
    }

    public function orWhere($column, $value)
    {
        return $this->model->orWhere($column, $value);
    }

    public function where($column, $value)
    {
        return $this->model->where($column, $value);
    }
}
