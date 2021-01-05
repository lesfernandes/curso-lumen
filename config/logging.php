<?php

use App\Logging\MySQLHandler;
use App\Logging\MySQLLogger;
use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;
use Monolog\Handler\TelegramBotHandler;
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Handler\NativeMailerHandler;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    */

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['browser_console', 'stream_handler', 'mysql'],
        ],

        'mysql' => [
            'driver' => 'custom',
            'via' => MySQLLogger::class,
            'handler' => MySQLHandler::class,
            'level' => 'debug'
        ],

        'telegram' => [
            'driver' => 'monolog',
            'level' => 'emergency',
            'handler' => TelegramBotHandler::class,
            'with' => [
                'channel' => env('CHANNEL_TELEGRAM'),
                'apiKey' => env('APIKEY_TELEGRAM')
            ]
        ],

        'email' => [
            'driver' => 'monolog',
            'level' => 'debug',
            'handler' => NativeMailerHandler::class,
            'with' => [
                'to' => 'lemayara16@gmail.com',
                'subject' => 'teste monolog',
                'from' => 'lemayara16@gmail.com'
            ]
        ],

        'browser_console' => [
            'driver' => 'monolog',
            'level' => 'debug',
            'handler' => BrowserConsoleHandler::class
        ],

        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/lumen.log'),
            'level' => 'debug',
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/lumen.log'),
            'level' => 'debug',
            'days' => 14,
        ],

        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'Lumen Log',
            'emoji' => ':boom:',
            'level' => 'critical',
        ],

        'papertrail' => [
            'driver' => 'monolog',
            'level' => 'debug',
            'handler' => SyslogUdpHandler::class,
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
            ],
        ],

        'stream_handler' => [
            'driver' => 'monolog',
            'handler' => StreamHandler::class,
            'level' => 'warning',
            'with' => [
                'stream' => storage_path('logs/teste.log'),
            ],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => 'debug',
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => 'debug',
        ],

        'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],
    ],

];
