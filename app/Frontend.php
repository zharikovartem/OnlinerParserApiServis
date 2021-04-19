<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Frontend
 *
 * @property int $id
 * @property string $name
 * @property mixed|null $src_tree
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Frontend newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Frontend newQuery()
 * @method static \Illuminate\Database\Query\Builder|Frontend onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Frontend query()
 * @method static \Illuminate\Database\Eloquent\Builder|Frontend whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Frontend whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Frontend whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Frontend whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Frontend whereSrcTree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Frontend whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Frontend withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Frontend withoutTrashed()
 * @mixin \Eloquent
 */
class Frontend extends Model
{
    use SoftDeletes;

    protected $table = "Frontend";

    protected $fillable = [
                "name",
                "src_tree",
    ];
}