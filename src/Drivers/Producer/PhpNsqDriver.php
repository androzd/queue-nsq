<?php

namespace Androzd\QueueNsq\Drivers\Producer;

use Androzd\QueueNsq\Exceptions\UnableConnectToNsqException;
use Nsq;

class PhpNsqDriver implements NsqProducerContract
{
    protected Nsq $nsq;
    public function __construct(array $config)
    {
        $nsqdAddr = [$config['uri']];
        $channel  = $config['channel'];

        $this->nsq = new Nsq(['channel' => $channel]);
        if (!$this->nsq->connectNsqd($nsqdAddr)) {
            throw new UnableConnectToNsqException(sprintf("Unable connect to Nsq [\"%s\"]", $nsqdAddr));
        }
    }

    public function __destruct()
    {
        $this->nsq->closeNsqdConnection();
    }

    public function publish($topic, $message): bool
    {
        return $this->nsq->publish($topic, $message);

    }

    public function deferredPublish($topic, $message, $deferTimeMs): bool
    {
        return $this->nsq->deferredPublish($topic, $message, $deferTimeMs);
    }
}