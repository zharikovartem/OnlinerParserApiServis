<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * App\ControllerMethods
 *
 * @property int $id
 * @property int $controller_id
 * @property string $name
 * @property mixed|null $request
 * @property mixed|null $response
 * @property string $rest_type
 * @property int|null $isMiddleware
 * @property string|null $body_actions
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ControllerMethods newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ControllerMethods newQuery()
 * @method static \Illuminate\Database\Query\Builder|ControllerMethods onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ControllerMethods query()
 * @method static \Illuminate\Database\Eloquent\Builder|ControllerMethods whereBodyActions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControllerMethods whereControllerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControllerMethods whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControllerMethods whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControllerMethods whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControllerMethods whereIsMiddleware($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControllerMethods whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControllerMethods whereRequest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControllerMethods whereResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControllerMethods whereRestType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ControllerMethods whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|ControllerMethods withTrashed()
 * @method static \Illuminate\Database\Query\Builder|ControllerMethods withoutTrashed()
 * @mixin \Eloquent
 */
class ControllerMethods extends Model
{
    use SoftDeletes;

    protected $table = "ControllerMethods";

    protected $fillable = [
                "controller_id",
                "request",
                "response",
                "rest_type",
                "isMiddleware",
                "body_actions",
                "name",
    ];
}