<?php

declare(strict_types=1);

$appName = 'Job Application Tracker';
$description = 'Track and manage your job applications in one place';

?>

<!DOCTYPE html>
<html lang="en>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?= htmlspecialchars($appName, ENT_QUOTES, 'UTF-8') ?></title>
    </head>
    <body>
        <main>
            <h1><?= htmlspecialchars($appName, ENT_QUOTES, 'UTF-8') ?></h1>

            <p><?= htmlspecialchars($description, ENT_QUOTES, 'UTF-8') ?></p>
        </main>
    </body>
</html>