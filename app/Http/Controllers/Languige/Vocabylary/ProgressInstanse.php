<?php

namespace App\Http\Controllers\Languige\Vocabylary;

class ProgressInstanse {
    /**
     * Count of wrong checks
     * @var int
     */
    public $errorLern=0;

    /**
     *Total count of checks
     * @var int
     */
    public $tryToLearn=0;

    /**
     * Count of success checks
     * @var int
     */
    public $successLern=0;

    public function __construct(string $paramSrtring = null) {
        if ($paramSrtring) {
            $data = json_decode($paramSrtring, true);
            if (isset($data['errorLern'])) $this->errorLern = (int) $data['errorLern'];
            if (isset($data['tryToLearn'])) $this->tryToLearn = (int) $data['tryToLearn'];
            if (isset($data['successLern'])) $this->successLern = (int) $data['successLern'];
        }         
    }

    /**
     * Преобразовывает данные в массив
     * @return array 
     */
    public function getArray()
    {
        return[
            'errorLern'=>$this->errorLern,
            'tryToLearn'=>$this->tryToLearn,
            'successLern'=>$this->successLern,
        ];
    }

    /**
     * Преобразовывает данные в массив
     * @param string $status
     * 
     * @return boolean 
     */
    public function editData($status)
    {
        $this->tryToLearn++;
        if ($status === 'success') {
            $this->successLern++;
        } else {
            $this->errorLern++;
        }

        return $this->checkStatus();
    }

    private function checkStatus()
    {
        if ($this->errorLern*2 < $this->successLern) {
            if ($this->tryToLearn>5) {
                return true;
            }
            return false;
        }
        return false;
    }
}