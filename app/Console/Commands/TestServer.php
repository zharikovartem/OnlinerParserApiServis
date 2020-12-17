<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use App\Classes\Socket\TestSocket;

class TestServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test_server:serve';

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
        $this->info('start server');

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new TestSocket(

                    )
                )
            ),
            8080
        );

        $server->run();
    }
}
