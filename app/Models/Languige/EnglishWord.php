<?php

namespace app\Models\Languige;

use App\Classes\Languige\AbstractWord;

class EnglishWord extends AbstractWord
{
    public function __construct($name, $occurrence, $description)
    {
        $this->name = $name;
        $this->languige = 'eng';
        $this->occurrence = $occurrence;
        $this->description = $description;
    }

    protected $table = 'EngleshWords';

    protected $fillable = [
        'id',
        'name',
        // 'is_active',
        // 'total_count',
        // 'type',
        // 'parent_id',
        // 'password',
        // 'created_at',
        // 'updated_at',
        // 'params',
        // 'label',
        // 'labels',
        // 'url',
        // 'full_url'
    ];

    protected $hidden = [];

    public function relations()
    {
        return $this->belongsToMany(RussianWord::class);
    }
}