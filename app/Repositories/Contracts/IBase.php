<?php


namespace App\Repositories\Contracts;

interface IBase
{
    public function all();
    public function datatable();
    public function find($id);
    public function getWhere($column, $operator, $value);
    public function getWhereFirst($column, $operator, $value);
    public function pagination($perPage);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function orWhere($column, $value);
    public function where($column, $value);
}
