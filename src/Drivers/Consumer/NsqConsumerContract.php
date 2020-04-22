<?php


namespace Androzd\QueueNsq\Drivers\Consumer;


interface NsqConsumerContract
{
    public function subscribe(string $topic, string $channel, callable $callback);
}