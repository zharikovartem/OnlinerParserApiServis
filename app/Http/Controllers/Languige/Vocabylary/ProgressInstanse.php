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
            $this->errorLern = (int) $data['errorLern'];
            $this->tryToLearn = (int) $data['tryToLearn'];
            $this->successLern = (int) $data['successLern'];
        }         
    }
}