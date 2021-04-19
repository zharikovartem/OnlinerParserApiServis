<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Providers
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Contacts[] $contacts
 * @property-read int|null $contacts_count
 * @method static \Illuminate\Database\Eloquent\Builder|Providers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Providers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Providers query()
 * @mixin \Eloquent
 */
class Providers extends Model
{
    protected $table = "Providers";

    protected $fillable = [
                "name",
    ];

    public function contacts()
    {
      return $this->hasMany(Contacts::class);
    }
}
