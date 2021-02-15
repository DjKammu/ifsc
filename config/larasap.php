<?php

return [

    'telegram' => [
        'api_token' => env('TELEGRAM_API_TOKEN', ''),
        'bot_username' => env('TELEGRAM_BOT_USERNAME', ''),
        'channel_username' => env('TELEGRAM_CHANNEL_USERNAME', ''),// Channel username to send message
        'channel_signature' => env('TELEGRAM_CHANNEL_SIGNATURE', ''), // This will be assigned in the footer of message
        'proxy' => false,   // True => Proxy is On | False => Proxy Off
    ],

    'twitter' => [
        'consurmer_key' => '',
        'consurmer_secret' => '',
        'access_token' => '',
        'access_token_secret' => ''
    ],

    'facebook' => [
        'app_id' => env('FACEBOOK_API_ID', ''),
        'app_secret' => env('FACEBOOK_API_SECRET', ''),
        'default_graph_version' => env('FACEBOOK_GRAPH_VERSION', ''),
        'page_access_token' => env('FACEBOOK_PAGE_ACCESS_TOKEN', '')
    ],

    // Set Proxy for Servers that can not Access Social Networks due to Sanctions or ...
    'proxy' => [
        'type' => '',   // 7 for Socks5
        'hostname' => '', // localhost
        'port' => '' , // 9050
        'username' => '', // Optional
        'password' => '', // Optional
    ]
];
