<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Services\Vocabulary\VocabularyParser;

class VocabularyParsingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $start;
    protected $stop;
    protected $part;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($start, $stop, $part)
    {
        $this->start = $start;
        $this->stop = $stop;
        $this->part = $part;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $newParser = new VocabularyParser($this->start, $this->stop, $this->part);
        $newParser->getVocabularyList();

        /*
        создания документа
        разбор полей на типы
        разбор маршрута каждого поля 
        */
        info('info'.$start);
    }
}
