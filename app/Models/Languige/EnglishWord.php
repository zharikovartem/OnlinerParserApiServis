<?php

namespace app\Models\Languige;

use App\Classes\Languige\AbstractWord;
use App\Models\Languige\RussianWord;

class EnglishWord extends AbstractWord
{
    // public function __construct($name, $occurrence, $description)
    // {
    //     echo 'neme: '.$name.'<br/>';
    //     $this->name = $name;
    //     $this->languige = 'eng';
    //     $this->occurrence = $occurrence;
    //     $this->description = $description;
    // }

    protected $table = 'EngleshWords';

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

    protected $hidden = [];

    public function relations()
    {
        return $this->belongsToMany(RussianWord::class);
    }
}