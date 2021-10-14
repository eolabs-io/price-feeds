<?php

namespace EolabsIo\PriceFeeds\Domain\Shared;

use WebSocket\Client as WebSocketClient;

abstract class BaseWebSocketClient
{
    private WebSocketClient $client;
    protected bool $isSubscribed;
    private bool $shouldGzDecode = false;
    private bool $shouldJsonDecode = true;

    public function __construct($client = null)
    {
        $this->isSubscribed = false;

        $url = $this->getWebSocketUrl();
        $options = $this->getWebSocketOptions();
        $this->client = $client ?? new WebSocketClient($url, $options);
    }

    abstract protected function getWebSocketUrl(): string;

    protected function getWebSocketOptions(): array
    {
        return [];
    }

    abstract protected function getSubscribeMessage(): array;

    abstract protected function getUnsubscribeMessage(): array;

    public function subscribeToChannel()
    {
        $subscribe = $this->getSubscribeMessage();

        $payload = json_encode($subscribe);

        $this->client->send($payload);
    }

    public function unsubscribeFromChannel()
    {
        $unsubscribe = $this->getUnsubscribeMessage();

        $payload = json_encode($unsubscribe);

        $this->client->send($payload);
    }

    public function start()
    {
        if (!$this->isSubscribed) {
            $this->subscribeToChannel();
        }

        $this->listen();
    }

    private function listen()
    {
        while (true) {
            try {
                $message = $this->decodeResponse($this->client->receive());
                $this->processMesssage($message);
                // Break while loop to stop listening
            } catch (\WebSocket\ConnectionException $e) {
                // Possibly log errors
            }
        }
    }

    protected function decodeResponse($response)
    {
        $payload = ($this->shouldGzDecode)
            ? gzdecode($response)
            : $response;

        $payload = ($this->shouldJsonDecode)
            ? json_decode((string) $payload, true)
            : $payload;

        return $payload;
    }

    abstract public function processMesssage($message);

    public function gzDecodeResponse($value = true)
    {
        $this->shouldGzDecode = $value;
    }

    public function jsonDecodeResponse($value = true)
    {
        $this->shouldJsonDecode = $value;
    }
}
