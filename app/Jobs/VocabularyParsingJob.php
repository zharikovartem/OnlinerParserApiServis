<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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
        // Создать сервис по парсингу https://audio-english.ru/frequencydict/s_1_po_500/page-0/
        // OnlinerParser::getCatalog();

        /*
        создания документа
        разбор полей на типы
        разбор маршрута каждого поля 
        */
    }
}
