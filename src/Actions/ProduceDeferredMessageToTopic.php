<?php


namespace Androzd\QueueNsq\Actions;


use Androzd\QueueNsq\Drivers\Producer\NsqProducerContract;

class ProduceDeferredMessageToTopic
{
    public function __invoke(string $message, string $topic, int $deferTimeMs): void
    {
        /** @var NsqProducerContract $driver */
        $driver = resolve(NsqProducerContract::class);
        $driver->deferredPublish($topic, $message, $deferTimeMs);
    }
}