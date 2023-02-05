<?php

<master></master>
require_once __DIR__ . '/../bootstrap/autoload.php';

$value = $_GET["key"];


echo $_ENV['REDIS_HOST_MASTER'];

$parameters = ["tcp://{$_ENV['REDIS_HOST_MASTER']}?role=master", "tcp://{$_ENV['REDIS_HOST_SLAVE']}"];
$options = [
    'replication' => 'predis',
    'parameters' => [
        'password' => $_ENV['REDIS_PASSWORD']
    ],
];

$redis = new Predis\Client($parameters, $options);

if (isset($value)) {
    $responses = $redis->transaction(function ($tx) use ($value) {

        $tx->set("key" . $value, $value);

    });
    dump($responses);
}


$list = $redis->keys("*");

foreach ($list as $key) {
    //Get Value of Key from Redis
    $value = $redis->get($key);

    //Print Key/value Pairs
    echo "<b>Key:</b> $key <br /><b>Value:</b> $value <br /><br />";
}
