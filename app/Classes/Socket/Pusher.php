<?php

namespace App\Classes\Socket;

use App\Classes\Socket\Base\BasePusher;
use ZMQContext;

class Pusher extends BasePusher {
    static function sendDataToServer(array $data) {
        $context = new ZMQContext();
        $socket = $context->getSocket(\ZMQ::SOCKET_PUSH, 'my pusher');

        $socket->connect('tcp://127.0.0.1:5555');

        $data = json_encode($data);

        $socket->send($data);
    }

    public function broadcast ($jsonDataToSend) {
        $dataToSend = json_decode($jsonDataToSend , true);

        $subscribedTopics = $this->getSubscribedTopics();

        if ( isset($subscribedTopics[ $dataToSend['topic_id'] ]) ) {
            $topic = $subscribedTopics[ $dataToSend['topic_id'] ];
            $topic->broadcast($dataToSend);
        }

    }
}