<?php

namespace App\Logging;

use Monolog\Logger;

class MySQLLogger {

    /**
     * Cria o Logger do MySQL.
     * @param array config
     * @return \Monolog\Logger
     */
    
    public function __invoke(array $config)
    {
        $logger = new Logger("MySQLHandler");
        return $logger->pushHandler(new MySQLHandler());
    }
}
