# androzd/queue-nsq
Laravel package for NSQ. This package NOT use laravel's api.

## Installation
First, require the package using Composer:

`composer require androzd/queue-nsq`

## Configuration

You can configure with env variables.

If you need more options to replace, you can publish and edit config file:
```shell script
php artisan vendor:publish --provider="Androzd\QueueNsq\QueueServiceProvider" --tag="config"
```

#### Produce new Nsq message:

```php
<?php

use Androzd\QueueNsq\Actions\ProduceMessageToTopic;

$message = json_encode(['id' => 'example message']);
$topic = 'example-topic';

$produceAction = new ProduceMessageToTopic();
$produceAction($message, $topic);
```

#### Produce new deferred Nsq message:

```php
<?php

use Androzd\QueueNsq\Actions\ProduceDeferredMessageToTopic;

$message = json_encode(['id' => 'example message']);
$topic = 'example-topic';

$produceDeferredAction = new ProduceDeferredMessageToTopic();
$produceDeferredAction($message, $topic, 10_000);//deferred time in ms
```

#### Listen Nsq topic:

```php
<?php

use Androzd\QueueNsq\Console\BaseConsumer;

class ExampleTopic extends BaseConsumer
{
    protected $signature = 'queue-work:example_topic';

    public function getTopic(): string
    {
        return 'example-topic';
    }

    public function process(NsqMessage $nsqMessage, $bev)
    {
        $payload = json_decode($nsqMessage->payload);
        // ... your code
    }
}
```

