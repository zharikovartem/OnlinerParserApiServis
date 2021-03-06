<?php

namespace app\Models\Languige;

use App\Classes\Languige\AbstractWord;
use App\Models\Languige\RussianWord;
use App\Http\Controllers\Languige\Vocabylary\userVocabylaryPovit;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * app\Models\Languige\EnglishWord
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\app\Models\Languige\RussianWord[] $relations
 * @property-read int|null $relations_count
 * @method static \Illuminate\Database\Eloquent\Builder|EnglishWord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnglishWord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EnglishWord query()
 * @mixin \Eloquent
 */
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

    public $relationsList;

    // /**
    // * Значение статуса 
    // * @var userVocabylaryPovit
    // */
    // public $pivot;

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function relations()
    {
        $this->relationsList = $this->belongsToMany(RussianWord::class);

        return $this->belongsToMany(RussianWord::class);
    }
}