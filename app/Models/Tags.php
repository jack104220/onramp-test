<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;

    protected $table = 'tbl_tags';

    public function records()
    {
        return $this->hasMany(TagRecords::class, 'object_id', 'object_id');
    }
}
