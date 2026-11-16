<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/src/database.php';

$schemaPath = dirname(__DIR__)
    . '/database/migrations/001_create_applications.sql';

$schema = file_get_contents($schemaPath);

if ($schema === false) {
    fwrite(STDERR, "Unable to read the database migration.\n");
    exit(1);
}

try {
    $connection = database();
    $connection->exec($schema);

    $tableName = $connection
        ->query(
            "SELECT name
             FROM sqlite_master
             WHERE type = 'table'
             AND name = 'applications'"
        )
        ->fetchColumn();

    if ($tableName !== 'applications') {
        throw new RuntimeException(
            'The applications table was not created.'
        );
    }

    fwrite(STDOUT, "Database initialized successfully.\n");
} catch (Throwable $exception) {
    fwrite(
        STDERR,
        "Database setup failed: {$exception->getMessage()}\n"
    );

    exit(1);
}