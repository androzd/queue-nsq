<?php


namespace Androzd\QueueNsq\Drivers\Producer;


interface NsqProducerContract
{
    public function publish($topic, $message): bool;

    public function deferredPublish($topic, $message, $deferTimeMs): bool;
}