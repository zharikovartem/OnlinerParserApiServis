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

use App\Services\Vocabulary\VocabularyParser;

class VocabularyCreateController extends Controller
{
    public function startVocabularyParsing()
    {
        # php artisan make:job VocabularyParsingJob // создать Job
        // dispatch(new VocabularyParsingJob);
        
        // dispatch((new VocabularyParsingJob(1 ,500, 0))->onQueue('vocabulary'));

        $newParser = new VocabularyParser(1, 500, 0);
        $newParser->getVocabularyList();

        return response()->json([
            "message"=> 'VocabularyParsingJob started1',
        ], 200);
    }
}