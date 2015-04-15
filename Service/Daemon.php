<?php

namespace Service;

/**
 * Daemon with single function:
 * increment number for each key
 */
Class Daemon extends SocketService
{
    /**
     * @var Cmd[]
     */
    private static $jobs = [];

    /**
     * @throws Exception
     */
    protected function openSocket()
    {
        self::$socket = socket_create(AF_INET, SOCK_STREAM, 0);
        if (!is_resource(self::$socket)) {
            throw new Exception("Can not open socket {$this->address}:{$this->port}");
        }
        socket_bind(self::$socket, $this->address, $this->port);
        socket_listen(self::$socket);

        $this->log("Daemon listening {$this->address}:{$this->port}");
    }

    /**
     * Start Daemon
     */
    public function run()
    {
        while (true) {
            $client = socket_accept(self::$socket);
            $readData = trim(socket_read($client, 4));

            if (empty(self::$jobs[$readData])) {
                self::$jobs[$readData] = new Cmd();
            }

            socket_write($client, self::$jobs[$readData]->getCount());
            socket_close($client);
        }
    }
}
