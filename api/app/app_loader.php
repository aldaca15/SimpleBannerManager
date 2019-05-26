<?php
$base = __DIR__ . '/../app/';

$folders = [
    'lib',
    'model',
    'middleware',
    'validation',
    'route',
];

foreach($folders as $f)
{
    foreach (glob($base . "$f/*.php") as $k => $filename)
    {
        require $filename;
    }
}

