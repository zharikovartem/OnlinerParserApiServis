<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ToDo
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ToDo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ToDo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ToDo query()
 * @mixin \Eloquent
 */
class ToDo extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 
    ];

}
