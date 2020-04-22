<?php

namespace Androzd\QueueNsq\Actions;

use Androzd\QueueNsq\Drivers\Producer\NsqProducerContract;

class ProduceMessageToTopic
{
    public function __invoke(string $message, string $topic): void
    {
        /** @var NsqProducerContract $driver */
        $driver = resolve(NsqProducerContract::class);
        $driver->publish($topic, $message);
    }
}