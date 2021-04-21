<?php

use Illuminate\Foundation\Inspiring;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Artisan;
>>>>>>> first commit

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
<<<<<<< HEAD
})->describe('Display an inspiring quote');
=======
})->purpose('Display an inspiring quote');
>>>>>>> first commit
