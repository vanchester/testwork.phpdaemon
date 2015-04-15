<?php

namespace Service;

/**
 * Client for read messages from Daemon
 */
Class Client extends SocketService
{
    /**
     * @throws Exception
     */
    protected function openSocket()
    {
        static::$socket = socket_create(AF_INET, SOCK_STREAM, 0);
        if (!is_resource(static::$socket)) {
            throw new Exception("Can not open {$this->address}:{$this->port}");
        }
        socket_connect(static::$socket, $this->address, $this->port);
    }

    /**
     * Read message from Daemon
     * @param $dataKey
     * @return string
     */
    public function read($dataKey)
    {
        socket_write(static::$socket, $dataKey);

        $readData = socket_read(static::$socket, 1024);
        socket_close(static::$socket);

        return $readData;
    }
}
