<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/database.php';

$database = database();

$applicationCount = (int) $database
    ->query('SELECT COUNT(*) FROM applications')
    ->fetchColumn();

if ($applicationCount > 0) {
    echo 'Seed skipped: applications table already contains data.' . PHP_EOL;
    exit(0);
}

$applications = [
    [
        'company' => 'Nordlicht Digital GmbH',
        'position' => 'Junior PHP Developer',
        'status' => 'applied',
        'applied_at' => '2026-08-18',
    ],
    [
        'company' => 'RheinCode Solutions',
        'position' => 'Frontend Developer',
        'status' => 'interview',
        'applied_at' => '2026-08-21',
    ],
    [
        'company' => 'Cobalt Systems',
        'position' => 'Junior Full Stack Developer',
        'status' => 'rejected',
        'applied_at' => '2026-08-23',
    ],
];

$statement = $database->prepare(
    <<<'SQL'
    INSERT INTO applications (company, position, status, applied_at)
    VALUES (:company, :position, :status, :applied_at)
    SQL
);

$database->beginTransaction();

try {
    foreach ($applications as $application) {
        $statement->execute($application);
    }

    $database->commit();

    echo 'Seeded '
        . count($applications)
        . ' applications successfully.'
        . PHP_EOL;
} catch (Throwable $exception) {
    if ($database->inTransaction()) {
        $database->rollBack();
    }

    fwrite(
        STDERR,
        'Database seeding failed: '
        . $exception->getMessage()
        . PHP_EOL
    );

    exit(1);
}