<?php

declare(strict_types=1);

namespace App\Core;

use MongoDB\Client;
use MongoDB\Collection;
use MongoDB\Database as MongoDatabase;

class Database
{
    private static ?Client $client = null;
    private static ?MongoDatabase $database = null;

    public static function connection(): MongoDatabase
    {
        if (self::$database === null) {
            $config = require BASE_PATH . '/config/config.php';

            self::$client = new Client($config['database']['uri']);
            self::$database = self::$client->selectDatabase($config['database']['name']);
        }

        return self::$database;
    }

    public static function collection(string $name): Collection
    {
        return self::connection()->selectCollection($name);
    }
}
