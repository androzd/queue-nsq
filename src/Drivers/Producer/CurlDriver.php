<?php


namespace Androzd\QueueNsq\Drivers\Producer;


class CurlDriver implements NsqProducerContract
{
    protected string $uri;

    public function __construct(array $config)
    {
        $this->uri = rtrim($config['uri'], '/');
    }

    public function publish($topic, $message): bool
    {
        $params = [
            'topic' => $topic
        ];
        return $this->produceMessage($params, $message);
    }

    public function deferredPublish($topic, $message, $deferTimeMs): bool
    {
        $params = [
            'topic' => $topic,
            'defer' => $deferTimeMs,
        ];

        return $this->produceMessage($params, $message);
    }

    protected function produceMessage(array $params, string $message)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->uri.'/pub?' . http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);

        $headers = ['Content-Type: application/json'];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        return 'OK' == $result;
    }
}