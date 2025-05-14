<?php

namespace App\Interfaces;


interface TaskInterface
{
    public function searchPaginate(array $filters);
    public function update(array $data, $id);
    public function create(array $data);
    public function getItem($idItem);
    public function getStatusList();
}
