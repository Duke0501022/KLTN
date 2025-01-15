<?php
require __DIR__ . '/../vendor/autoload.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

class ChatWebSocket implements MessageComponentInterface {
    protected $clients;
    protected $users = [];

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg, true);
        foreach ($this->clients as $client) {
            if ($from !== $client) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}

try {
    // Try alternate ports if 8080 is blocked
    $ports = [8080, 8081, 8082, 3000];
    $server = null;
    
    foreach ($ports as $port) {
        try {
            $server = IoServer::factory(
                new HttpServer(
                    new WsServer(
                        new ChatWebSocket()
                    )
                ),
                $port,
                '127.0.0.1' // Use localhost instead of 0.0.0.0
            );
            echo "WebSocket server started on port $port\n";
            break;
        } catch (\Exception $e) {
            continue;
        }
    }
    
    if ($server) {
        $server->run();
    } else {
        throw new \Exception("Could not find available port");
    }
} catch (\Exception $e) {
    echo "Fatal error: " . $e->getMessage() . "\n";
    exit(1);
}