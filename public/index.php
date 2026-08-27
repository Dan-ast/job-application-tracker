<?php

declare(strict_types=1);

function escape(string $value): string
{
    return htmlspecialchars(
        $value,
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
}

$appName = 'Job Application Tracker';
$description = 'Track and manage your job applications in one place';

$applications = [
    [
        'id' => 1,
        'company' => 'Nordlicht Digital GmbH',
        'position' => 'Junior PHP Developer',
        'status' => 'applied',
        'applied_at' => '2026-08-18',
    ],
    [
        'id' => 2,
        'company' => 'RheinCode Solutions',
        'position' => 'Frontend Developer',
        'status' => 'interview',
        'applied_at' => '2026-08-21',
    ],
    [
        'id' => 3,
        'company' => 'Cobalt Systems',
        'position' => 'Junior Full Stack Developer',
        'status' => 'rejected',
        'applied_at' => '2026-08-23',
    ],
];



?>

<!DOCTYPE html>
<html lang="en>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/assets/css/app.css">

        <title><?= escape($appName) ?></title>
    </head>
    <body>
        <main class="page-container">
            <h1><?= escape($appName) ?></h1>

            <p class="page-intro"><?= escape($description) ?></p>
            <section class="applications-panel" aria-labelledby="application-heading">
                <h2 id="application-heading">Applications</h2>

                <?php if ($applications === []): ?>
                    <p>No job applications found.</p>
                <?php else: ?>
                    <div class="table-wrapper">
                        <table>
                            <caption>Current job applications</caption>

                            <thead>
                                <tr>
                                    <th scope="col">Company</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Applied at</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($applications as $application): ?>
                                    <tr>
                                        <td><?= escape($application['company']) ?></td>
                                        <td><?= escape($application['position']) ?></td>
                                        <td><?= escape(ucfirst($application['status'])) ?></td>
                                        <td><?= escape($application['applied_at']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </section>
        </main>
    </body>
</html>