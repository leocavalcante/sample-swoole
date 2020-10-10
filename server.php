#!/usr/bin/php
<?php declare(strict_types=1);
require __DIR__ . '/vendor/autoload.php';

use Cowsayphp\Farm;
use Swoole\Http\Request;
use Swoole\Http\Response;

$cow = Farm::create(\Cowsayphp\Farm\Cow::class);

$handler = static function (Request $request, Response $response) use ($cow): void {
    $text = $request->get['message'] ?? "Set a message by adding ?message=<message here> to the URL";
    $response->header('Content-Type', 'text/plain');
    $response->end($cow->say($text));
};


$port = (int)($_ENV['PORT'] ?? 9501);
echo "Listening on $port\n";

$server = new Swoole\Http\Server('0.0.0.0', $port);
$server->on('request', $handler);
$server->start();