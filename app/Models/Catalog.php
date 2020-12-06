<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $table = 'Catalog';

    protected $fillable = [
        'id',
        'name',
        'type',
        'parent_id',
        'password',
        'created_at',
        'updated_at',
        'params',
        'label',
        'labels',
        'url',
        'full_url'
    ];
}
