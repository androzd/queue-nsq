<?php

namespace Androzd\QueueNsq\Drivers\Consumer;

use Androzd\QueueNsq\Exceptions\UnableConnectToNsqException;
use Nsq;
use NsqLookupd;

class PhpNsqDriver implements NsqConsumerContract
{
    protected Nsq $nsq;
    protected NsqLookupd $nsqLookupd;
    protected string $uri;
    protected array $subscribeConfig;
    public function __construct(array $config)
    {
        $channel  = $config['channel'];
        $this->uri = $config['uri'];

        $this->nsq = new Nsq(['channel' => $channel]);
        $this->nsqLookupd = new NsqLookupd($config['uri']);

        $this->subscribeConfig = [
            'rdy' => 2,
            'connect_num' => 1,
            'retry_delay_time' => 5000,
            'auto_finish' => true,
        ];
    }

    public function __destruct()
    {
        $this->nsq->closeNsqdConnection();
    }

    public function subscribe(string $topic, string $channel, callable $callback) {
        $config = $this->subscribeConfig;
        $config['topic'] = $topic;
        $config['channel'] = $channel;
        $this->nsq->subscribe(
            $this->nsqLookupd,
            $config,
            $callback
        );
    }
}