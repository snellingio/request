<?php

include __DIR__ . '/../vendor/autoload.php';

$request = new Snelling\Request();

$name = $request->get()['name'] ?? 'Sam';

echo 'Hello ' . $name;