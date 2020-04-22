<?php


namespace Androzd\QueueNsq;

use Androzd\QueueNsq\Drivers\Producer\NsqProducerContract;
use Androzd\QueueNsq\Drivers\Producer\CurlDriver as ProducerCurlDriver;
use Androzd\QueueNsq\Drivers\Producer\PhpNsqDriver as ProducerPhpNsqDriver;
use Androzd\QueueNsq\Drivers\Consumer\NsqConsumerContract;
use Androzd\QueueNsq\Drivers\Consumer\PhpNsqDriver as ConsumerPhpNsqDriver;
use Androzd\QueueNsq\Exceptions\UnknownQueueConnection;
use Illuminate\Support\ServiceProvider;

class QueuesServiceProvider extends ServiceProvider
{
    protected function configPath(): string
    {
        return __DIR__ . '/../config/nsq.php';
    }

    public function boot()
    {
        $this->publishes(
            [
                $this->configPath() => config_path('nsq.php'),
            ],
            'config'
        );
    }

    public function register()
    {
        $this->mergeConfigFrom(
            $this->configPath(),
            'nsq'
        );

        $this->app->singleton(
            NsqProducerContract::class,
            function ($app) {
                $config = config('nsq.producer');

                $connection = $config['connection'];
                $configConnection = $config['connections'][$connection];

                switch ($configConnection['driver']) {
                    case 'php-nsq':
                        return new ProducerPhpNsqDriver($configConnection);
                    case 'curl':
                        return new ProducerCurlDriver($configConnection);
                }
                throw new UnknownQueueConnection(sprintf("Nsq connection \"%s\" not found", $config['connection']));
            }
        );

        $this->app->singleton(
            NsqConsumerContract::class,
            function ($app) {
                $config = config('nsq.consumer');

                $connection = $config['connection'];
                $configConnection = $config['connections'][$connection];

                switch ($configConnection['driver']) {
                    case 'php-nsq':
                        return new ConsumerPhpNsqDriver($configConnection);
                }
                throw new UnknownQueueConnection(sprintf("Nsq connection \"%s\" not found", $config['connection']));
            }
        );
    }
}