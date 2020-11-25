<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Catalog;
use  App\Services\Parsers\OnlinerParser;


class CatalogParsingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $catalog;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->catalog = $catalog;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // dd($this->catalog);
        // \Artisan::call('onliner:parse');
        // $onlinerParser = new OnlinerParser();

        // dd($onlinerParser);
        // $blabla = $onlinerParser->getProductCatalog();

        OnlinerParser::getProductCatalog();
        info('info');

        echo 'Выполняем парсинг123<br/>';
    }
}
