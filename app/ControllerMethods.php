<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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
    ];
}