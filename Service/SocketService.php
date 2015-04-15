<?php

namespace Service;

abstract class SocketService
{
    protected $address;
    protected $port;

    protected static $socket;

    /**
     * Init and configure SocketService by array with params
     * @param array $config
     * @return static
     */
    public static function init($config = [])
    {
        if (!is_array($config)) {
            $config = [];
        }
        static $instance = null;
        if (is_null($instance)) {
            $defaultConfig = [
                'address' => '127.0.0.1',
                'port' => '9988'
            ];

            $config = array_merge($defaultConfig, $config);

            $instance = new static($config['address'], $config['port']);
        }

        return $instance;
    }

    protected function __construct($address, $port)
    {
        $this->address = $address;
        $this->port = $port;

        $this->openSocket();
    }

    abstract protected function openSocket();

    /**
     * @param $message
     */
    protected function log($message)
    {
        echo $message . PHP_EOL;
    }

    protected function __clone()
    {
    }

    protected function __wakeup()
    {
    }

    public function __destroy()
    {
        socket_close(static::$socket);
    }
}
