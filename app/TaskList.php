<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * App\TaskList
 *
 * @property int $id
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $name
 * @property int $user_id
 * @property string|null $descriptions
 * @property string|null $time_to_complete
 * @property int|null $task_type
 * @property mixed|null $data
 * @method static \Illuminate\Database\Eloquent\Builder|TaskList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskList newQuery()
 * @method static \Illuminate\Database\Query\Builder|TaskList onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskList query()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskList whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskList whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskList whereDescriptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskList whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskList whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskList whereTaskType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskList whereTimeToComplete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskList whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskList whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|TaskList withTrashed()
 * @method static \Illuminate\Database\Query\Builder|TaskList withoutTrashed()
 * @mixin \Eloquent
 */
class TaskList extends Model
{
    use SoftDeletes;
    
    protected $table = 'Task';
}
