<?php

namespace App\Logging;

use App\Models\Log;
use Monolog\Handler\AbstractProcessingHandler;

class MySQLHandler extends AbstractProcessingHandler{

    protected function write(array $record): void
    {
        Log::create([
            "instance" => gethostname(),
            "message" => $record["message"],
            "context" => $record["context"],
            "level" => $record["level_name"],
            "channel" => $record["channel"],
        ]);
    }

}
