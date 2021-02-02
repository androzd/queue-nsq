<?php

# This file required for syntax highlighting of the php-nsq extension
namespace {
    const NSQ_ERROR_NONE = 0;
    const NSQ_ERROR_NO_CONNECTION = 1;
    const NSQ_ERROR_UNABLE_TO_PUBLISH_MESSAGE = 2;
    const NSQ_ERROR_TOPIC_KEY_REQUIRED = 3;
    const NSQ_ERROR_CHANNEL_KEY_REQUIRED = 4;
    const NSQ_ERROR_LOOKUPD_SERVER_NOT_AVAILABLE = 5;
    const NSQ_ERROR_PUB_LOST_CONNECTION = 6;
    const NSQ_ERROR_TOPIC_NOT_EXISTS = 7;
    const NSQ_ERROR_CALLBACK_FUNCTION_IS_NOT_CALLABLE = 8;
    const NSQ_ERROR_LIBEVENT_COULD_NOT_BE_INITIALIZED = 9;
    const NSQ_ERROR_CONNECTION_FAILED = 10;

    class Nsq
    {
        public $nsqConfig;
        public $nsqd_connection_fds;
        public $conn_timeout;

        public function __construct(array $nsq_config = [])
        {
        }

        /** @return bool */
        public function connectNsqd($connectaddr_arr)
        {
        }

        /** @return bool */
        public function closeNsqdConnection()
        {
        }

        /** @return bool */
        public function publish($topic, $msg)
        {
        }

        /** @return bool */
        public function deferredPublish($topic, $msg, $delay_time)
        {
        }

        public function subscribe($nsq_lookupd, $config, $callback)
        {
        }
    }

    class NsqLookupd
    {
        public $address;

        public function __construct(string $lookup_address)
        {
        }
    }

    class NsqMessage
    {
        public $message_id;
        public $messageId;
        public $timestamp;
        public $attempts;
        public $payload;

        public function touch($bev_zval, $message_id)
        {
        }

        public function requeue($bev_zval, $message_id, $time_ms)
        {
        }

        public function finish($bev_zval, $message_id)
        {
        }
    }

    class NsqException extends \Exception
    {
    }
}
