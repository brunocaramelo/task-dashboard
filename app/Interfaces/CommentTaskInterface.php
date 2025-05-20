<?php

namespace App\Interfaces;


interface CommentTaskInterface
{
    public function update(array $data, $id);
    public function create(array $data);

}
