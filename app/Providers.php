<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Providers extends Model
{
    protected $table = "Providers";

    protected $fillable = [
                "name",
    ];
}