<?php

declare(strict_types=1);

function database(): PDO
{
    static $connection = null;

    if ($connection instanceof PDO) {
        return $connection;
    }

    $storageDirectory = dirname(__DIR__) . '/storage';

    if (
        !is_dir($storageDirectory)
        && !mkdir($storageDirectory, 0775, true)
        && !is_dir($storageDirectory)
    ) {
        throw new RuntimeException(
            'Unable to create the database storage directory.'
        );
    }

    $databasePath = $storageDirectory . '/database.sqlite';

    $connection = new PDO('sqlite:' . $databasePath);

    $connection->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

    $connection->setAttribute(
        PDO::ATTR_DEFAULT_FETCH_MODE,
        PDO::FETCH_ASSOC
    );

    $connection->exec('PRAGMA foreign_keys = ON');

    return $connection;
}