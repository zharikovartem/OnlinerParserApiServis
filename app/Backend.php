<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Backend
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $name
 * @property string|null $url
 * @property string|null $ip
 * @property string|null $login
 * @property string|null $password
 * @property string|null $folder
 * @method static \Illuminate\Database\Eloquent\Builder|Backend newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Backend newQuery()
 * @method static \Illuminate\Database\Query\Builder|Backend onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Backend query()
 * @method static \Illuminate\Database\Eloquent\Builder|Backend whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backend whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backend whereFolder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backend whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backend whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backend whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backend whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backend wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backend whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Backend whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|Backend withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Backend withoutTrashed()
 * @mixin \Eloquent
 */
class Backend extends Model
{
    use SoftDeletes;

    protected $table = 'Backend';
}
