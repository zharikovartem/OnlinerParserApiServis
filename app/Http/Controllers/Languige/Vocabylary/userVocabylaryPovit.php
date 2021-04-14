<?php

namespace App\Http\Controllers\Languige\Vocabylary;

use App\Http\Controllers\Languige\Vocabylary\ProgressInstanse;

class UserVocabylaryPovit{
    /**
     * Значение статуса 
     * @var string
     */
    public $status;

    /**
     * @var int
     */
    public $english_word_id;

    /**
     * @var int
     */
    public $user_id;

    /**
     * Значение статуса 
     * @var ProgressInstanse
     */
    public $progress;

    /**
     * Значение статуса 
     * @var ProgressInstanse
     */
    public $progress_ru_en_c;

    /**
     * Значение статуса 
     * @var ProgressInstanse
     */
    public $progress_en_ru_c;

    /**
     * Значение статуса 
     * @var ProgressInstanse
     */
    public $progress_ru_en_s;

    /**
     * Значение статуса 
     * @var ProgressInstanse
     */
    public $progress_en_ru_s;

    /**
     * Значение статуса 
     * @var ProgressInstanse
     */
    public $progress_ru_en_r;

    /**
     * Значение статуса 
     * @var ProgressInstanse
     */
    public $progress_en_ru_r;

    public function __construct(array $data = null)
    {
        if ($data) {
            // $data = json_decode($paramSrtring, true);
            $this->status = $data['status'];
            $this->english_word_id = (int) $data['english_word_id'];
            $this->user_id = (int) $data['user_id'];

            $this->progress = new ProgressInstanse($data['progress']);
            $this->progress_ru_en_c = isset($data['progress_ru_en_c']) ? new ProgressInstanse($data['progress_ru_en_c']) : new ProgressInstanse();
            $this->progress_en_ru_c = new ProgressInstanse($data['progress_en_ru_c']);
            // $this->progress_ru_en_s = new ProgressInstanse($data['progress_ru_en_s']);
            // $this->progress_en_ru_s = new ProgressInstanse($data['progress_en_ru_s']);
            // $this->progress_ru_en_r = new ProgressInstanse($data['progress_ru_en_r']);
            // $this->progress_en_ru_r = new ProgressInstanse($data['progress_en_ru_r']);
        }
        
    }

    /**
     * Преобразовывает данные в массив
     * @return array 
     */
    public function getArray()
    {
        return [
            'status'=>$this->status,
            'english_word_id'=>$this->english_word_id,
            'user_id'=>$this->user_id,

            'progress'=>$this->progress->getArray(),
            'progress_ru_en_c'=>$this->progress_ru_en_c->getArray(),
            'progress_en_ru_c'=>$this->progress_en_ru_c->getArray(),
            'progress_ru_en_s'=>$this->progress_ru_en_s->getArray(),
            'progress_en_ru_s'=>$this->progress_en_ru_s->getArray(),
            'progress_ru_en_r'=>$this->progress_ru_en_r->getArray(),
            'progress_en_ru_r'=>$this->progress_en_ru_r->getArray()
        ];
    }

    /**
     * Преобразовывает данные в массив
     * @param string $checkMethod
     */
    public function editProperty($checkMethod)
    {
        $fieldName = 'progress_'.$checkMethod;
        $this->$fieldName->editData();
    }

}