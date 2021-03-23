<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use DiDom\Document;

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
                "occurrence",
                "babla_url",
                "eng_sound",
    ];

    public function getYandexData()
    {
        echo $this->yandex_url.'<br/>';
        $document = new Document($this->yandex_url, true);
        // 
        $this->part_of_speech = $document->find('.dictionary-pos')[0]->getAttribute('title');
        $this->save();
    }
}