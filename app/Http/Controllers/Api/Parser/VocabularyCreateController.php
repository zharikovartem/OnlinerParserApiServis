<?php

namespace App\Http\Controllers\Api\Parser;

use App\Services\Parsers\OnlinerParser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\CatalogParsingJob;
use App\Jobs\VocabularyParsingJob;
// use App\Jobs\ProductParamParsingJob;
// use App\Models\Catalog;
use App\Models\Languige\EnglishWord;
use App\Models\Languige\RussianWord;

use Illuminate\Support\Facades\DB;
// use Carbon\Carbon;

class VocabularyCreateController extends Controller
{
    public function startVocabularyParsing()
    {
        # php artisan make:job VocabularyParsingJob // создать Job
        // dispatch(new VocabularyParsingJob);
        dispatch((new VocabularyParsingJob(1 ,500, 0))->onQueue('vocabulary'));

        return response()->json([
            "message"=> 'VocabularyParsingJob started',
        ], 200);
    }
}