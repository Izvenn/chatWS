<?php

// Create a WebSocket Server object and listen on 0.0.0.0:9502.
$ws = new Swoole\WebSocket\Server('0.0.0.0', 9502);

// Listen to the WebSocket connection open event.
$ws->on('Open', function ($ws, $request) {
    $ws->push($request->fd, "hello, welcome\n");
});

// Listen to the WebSocket message event.
$ws->on('Message', function ($ws, $frame) {
    echo "Message: {$frame->data}\n";
    $ws->push($frame->fd, "server: {$frame->data}");
});

// Listen to the WebSocket connection close event.
$ws->on('Close', function ($ws, $fd) {
    echo "client-{$fd} is closed\n";
});

$ws->start();