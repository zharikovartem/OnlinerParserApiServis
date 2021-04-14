<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
                "providerId",
    ];
}