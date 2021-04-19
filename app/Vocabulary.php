<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use DiDom\Document;

/**
 * App\Vocabulary
 *
 * @property int $id
 * @property string $eng_value
 * @property string $rus_value
 * @property string $part_of_speech
 * @property string $gender
 * @property int|null $is_irregular_verb
 * @property string|null $yandex_url
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $occurrence
 * @property string|null $babla_url
 * @property string|null $eng_sound
 * @method static \Illuminate\Database\Eloquent\Builder|Vocabulary newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vocabulary newQuery()
 * @method static \Illuminate\Database\Query\Builder|Vocabulary onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Vocabulary query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vocabulary whereBablaUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vocabulary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vocabulary whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vocabulary whereEngSound($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vocabulary whereEngValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vocabulary whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vocabulary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vocabulary whereIsIrregularVerb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vocabulary whereOccurrence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vocabulary wherePartOfSpeech($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vocabulary whereRusValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vocabulary whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vocabulary whereYandexUrl($value)
 * @method static \Illuminate\Database\Query\Builder|Vocabulary withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Vocabulary withoutTrashed()
 * @mixin \Eloquent
 */
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