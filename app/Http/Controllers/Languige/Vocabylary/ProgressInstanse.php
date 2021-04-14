<?php

namespace App\Http\Controllers\Languige\Vocabylary;

class ProgressInstanse {
    /**
     * Count of wrong checks
     * @var int
     */
    public $errorLern;

    /**
     *Total count of checks
     * @var int
     */
    public $tryToLearn;

    /**
     * Count of success checks
     * @var int
     */
    public $successLern;

    public function __construct(string $paramSrtring) {
        $data = json_decode($paramSrtring, true);
        $this->errorLern = (int) $data['errorLern'];
        $this->tryToLearn = (int) $data['tryToLearn'];
        $this->successLern = (int) $data['successLern'];
    }
}