<?php

namespace Androzd\QueueNsq\Console;

use Androzd\QueueNsq\Drivers\Consumer\NsqConsumerContract;
use Illuminate\Console\Command;
use NsqMessage;

abstract class BaseConsumer extends Command
{
    public function handle()
    {
        $nsq = resolve(NsqConsumerContract::class);

        $nsq->subscribe(
            $this->getTopic(),
            $this->getChannel(),
            function(NsqMessage $nsqMessage, $bev) {
                // $this->warn(sprintf('[%s] Processing [%s]', now()->format('Y-m-d H:i:s'), $nsqMessage->messageId));
                $this->process($nsqMessage, $bev);
                // $this->info(sprintf('[%s] Processed [%s]', now()->format('Y-m-d H:i:s'), $nsqMessage->messageId));
            }
        );
    }

    abstract public function getTopic(): string;

    public function getChannel(): string
    {
        return 'web';
    }

    abstract public function process(NsqMessage $nsqMessage, $bev);
}
