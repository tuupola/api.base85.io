<?php

/*
 * This file is part of the Slim API skeleton package
 *
 * Copyright (c) 2016-2017 Mika Tuupola
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Project home:
 *   https://github.com/tuupola/slim-api-skeleton
 *
 */

date_default_timezone_set("UTC");

use Tuupola\Base85;

require __DIR__ . "/vendor/autoload.php";

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$app = new \Slim\App([
    "settings" => [
        "displayErrorDetails" => true,
        "addContentLengthHeader" => false,
    ]
]);

require __DIR__ . "/config/dependencies.php";
require __DIR__ . "/config/handlers.php";
require __DIR__ . "/config/middleware.php";

$app->post("/encode", function ($request, $response, $arguments) {
    $body = $request->getParsedBody();
    $encoded = (new Base85)->encode($body["data"]);
    return $response->withStatus(200)
        ->withHeader("Content-Type", "application/json")
        ->write(json_encode(["encoded" => $encoded], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});

$app->post("/decode", function ($request, $response, $arguments) {
    $body = $request->getParsedBody();
    $decoded = (new Base85)->decode($body["data"]);

    return $response->withStatus(200)
        ->withHeader("Content-Type", "application/json")
        ->write(json_encode(["decoded" => $decoded], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
});

$app->run();
