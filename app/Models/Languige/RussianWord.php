<?php

namespace app\Models\Languige;

use App\Models\Languige\EngleshWord;
use App\Classes\Languige\AbstractWord;

class RussianWord extends AbstractWord
{
    protected $table = 'RussianWords';
    
    protected $fillable = [
        'id',
        'name',
        'languige',
        'occurrence',
        'description',
        'isBasic',
        'isContain',
        'gender',
        'part_of_speech',
        'word_number',
        'conjugation',
        'examples',
    ];

    public function relations()
    {
        return $this->belongsToMany(EngleshWords::class);
    }
}