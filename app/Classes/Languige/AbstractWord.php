<?php

namespace App\Classes\Languige;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractWord extends Model
{
    protected $table; // название таблици
    protected $fillable = [
        'id',
        'name',
        'languige',
        'word_number'
    ];

    protected $name; // Имя (значение на родном языке)
    protected $languige; // К какому языку пренадлежит
    protected $isBasic; // Является ли слово основным
    protected $isContain; // Были ли заполнены поля слова

    public $gender; // род 
    public $part_of_speech; // часть речи 
    public $word_number; // Множественное или единственное число
    public $conjugation; // спряжение

    public $examples; // Примеры использования

    /* get value List */
    abstract protected function getValues():array;
    /* get data for instanse */
    abstract protected function getCurrentData():array;

    abstract public function relations();

    // protected function getRelations()
    // {
    //     // Массив связанных слов
    // }

    protected function setTransletValues()
    {
        $urlPart = $this->languige === 'eng' ? 'английский-русский' : 'русский-английский';
    }

}