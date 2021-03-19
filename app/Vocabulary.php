<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vocabulary extends Model
{
    use SoftDeletes;

    protected $table = "Vocabulary";

    protected $fillable = [
                "eng_value",
                "rus_value",
                "part_of_speech",
                "gender",
                "is_irregular_verb",
                "yandex_url",
    ];

    public function getYandexData()
    {
        echo $this->yandex_url.'<br/>';
    }
}