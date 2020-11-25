<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Catalog;

class OnlinerParse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Onliner:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Catalog::create(
        //     [
        //         'name'=>'123',
        //         'parent_id'=>'0',
        //         'label'=>'123',
        //         'labels'=>'startCatalogParsing'
        //     ]
        // );

        echo 'onliner:parse STARTED';
    }
}
