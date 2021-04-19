<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\ModelsInstanse
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $name
 * @property mixed|null $fields
 * @property int|null $backend_id
 * @property string|null $folder
 * @property int|null $soft_delete
 * @method static \Illuminate\Database\Eloquent\Builder|ModelsInstanse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelsInstanse newQuery()
 * @method static \Illuminate\Database\Query\Builder|ModelsInstanse onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelsInstanse query()
 * @method static \Illuminate\Database\Eloquent\Builder|ModelsInstanse whereBackendId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModelsInstanse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModelsInstanse whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModelsInstanse whereFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModelsInstanse whereFolder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModelsInstanse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModelsInstanse whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModelsInstanse whereSoftDelete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ModelsInstanse whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ModelsInstanse withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ModelsInstanse withoutTrashed()
 * @mixin \Eloquent
 */
class ModelsInstanse extends Model
{
    use SoftDeletes;

    // protected $table = 'ModelsInstanse';
    protected $table = 'Models_instanses';

    protected $fillable = [
        'name', 
        'backend_id',
        'folder'
    ];
}
