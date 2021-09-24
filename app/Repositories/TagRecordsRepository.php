<?php

namespace App\Repositories;

use App\Models\TagRecords;

class TagRecordsRepository
{
    public function __construct(protected TagRecords $model) {}

    public function insert($params)
    {
        $model = new TagRecords();
        foreach ($params as $column => $value) {
            $model->$column = $value;
        }
        $model->save();
        return $model;
    }
}