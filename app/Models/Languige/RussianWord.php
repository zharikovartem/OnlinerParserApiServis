<?php

namespace app\Models\Languige;

use App\Classes\Languige\AbstractWord;

class RussianWord extends AbstractWord
{
    public function __construct($name)
    {
        $this->name = $name;
        $this->languige = 'rus';
    }
}