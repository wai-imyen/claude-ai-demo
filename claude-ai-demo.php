<?php

require_once './load-env.php';

$anthropicApiKey = getenv('ANTHROPIC_API_KEY');
$model = getenv('ANTHROPIC_MODEL');
$maxTokens = getenv('ANTHROPIC_MAX_TOKEN');
$messages = [
    [
        'role' => 'user',
        'content' => 'Hello world!'
    ]
];

$headers = [
    'x-api-key: ' . $anthropicApiKey,
    'anthropic-version: 2023-06-01',
    'content-type: application/json'
];

$data = json_encode([
    'model' => $model,
    'max_tokens' => $maxTokens,
    'messages' => $messages
]);

$ch = curl_init('https://api.anthropic.com/v1/messages');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);
curl_close($ch);

echo $response;


