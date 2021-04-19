<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Contacts
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Contacts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contacts newQuery()
 * @method static \Illuminate\Database\Query\Builder|Contacts onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Contacts query()
 * @method static \Illuminate\Database\Query\Builder|Contacts withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Contacts withoutTrashed()
 * @mixin \Eloquent
 */
class Contacts extends Model
{
    use SoftDeletes;

    protected $table = "Contacts";

    protected $fillable = [
                "name",
                "phone",
                "Skype",
                "Viber",
                "Telegram",
                "WhatsApp",
                "providers_id",
    ];
}