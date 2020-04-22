<?php

return [
    'producer' => [
        'connection' => 'php-nsq',
        'connections' => [
            'php-nsq' => [
                'driver' => 'php-nsq',
                'uri' => env('NSQ_PRODUCER_PHP_NSQ_URI', 'nsqd:4150'),
                'channel' => env('NSQ_PRODUCER_PHP_NSQ_CHANNEL', 'web'),
            ],
            'curl' => [
                'driver' => 'curl',
                'uri' => env('NSQ_PRODUCER_CURL_URI', 'http://nsqd:4151'),
            ]
        ]
    ],
    'consumer' => [
        'connection' => 'php-nsq',
        'connections' => [
            'php-nsq' => [
                'driver' => 'php-nsq',
                'uri' => env('NSQ_CONSUMER_PHP_NSQ_URI', 'nsqlookupd:4161'),
                'channel' => 'web',
            ],
        ]
    ]
];