<?php

declare(strict_types=1);

require_once __DIR__ .'/../src/helpers.php';

$values = [
    'company' => '',
    'position' => '',
    'status' => 'applied',
    'applied_at' => '',
];

$errors = [];
$isValid = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($values as $field => $defaultValue) {
        $submittedValue = $_POST[$field] ?? '';

        $values[$field] = is_string($submittedValue) ? trim($submittedValue) : '';
    }

    foreach (['company' => 'Company', 'position' => 'Position'] as $field => $label) {
        if ($values[$field] === '') {
            $errors[$field] = "$label is required.";
        } elseif (preg_match('/\A.{1,255}\z/us', $values[$field]) !== 1) {
            $errors[$field] = "$label must be valid text of no more than 255 characters.";
        }
    }

    $allowedStatuses = ['applied', 'interview', 'rejected'];

    if (!in_array($values['status'], $allowedStatuses, true)) {
        $errors['status'] = 'Choose a valid application status.';
    }

    $dateIsValid = false;

    if (preg_match('/\A[0-9]{4}-[0-9]{2}-[0-9]{2}\z/', $values['applied_at']) === 1) {
        [$year, $month, $day] = explode('-', $values['applied_at']);

        $dateIsValid = checkdate(
            (int) $month,
            (int) $day,
            (int) $year
        );
    }

    if (!$dateIsValid) {
        $errors['applied_at'] = 'Enter a valid application date.';
    }

    $isValid = $errors === [];

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/assets/css/app.css">

    <title>Add application | Job Application Tracker</title>
</head>
<body>
    <main class="page-container">
        <a class="back-link" href="/">⬅️ Back to applications</a>

        <h1>Add application</h1>

        <p class="page-intro">
            Enter the details of your job application.
        </p>

        <?php if ($errors !== []): ?>
            <div class="form-message form-message--error" role="alert">
                <p>Please correct the following:</p>

                <ul>
                    <?php foreach ($errors as $field => $message): ?>
                        <li>
                            <a href="#<?= escape($field) ?>">
                                <?= escape($message) ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                </ul>
            </div>

        <?php elseif ($isValid): ?>
            <p class="form-message form-message--success" role="status">
                The details are valid. Nothing has been saved yet.
            </p>
        <?php endif; ?>

        <form class="applications-panel application-form" action="/create.php" method="post" novalidate>
            <div class="form-field">
                <label for="company">Company</label>
                <input
                    type="text"
                    id="company"
                    name="company"
                    value="<?= escape($values['company']) ?>"
                    maxlength="255"
                    required
                >
            </div>

            <div class="form-field">
                <label for="position">Position</label>
                <input
                    type="text"
                    id="position"
                    name="position"
                    value="<?= escape($values['position']) ?>"
                    maxlength="255"
                    required
                >
            </div>

            <div class="form-field">
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="">Choose a status</option>
                    <option value="applied" <?= $values['status'] === 'applied' ? 'selected' : '' ?>>
                        Applied
                    </option>
                    <option value="interview" <?= $values['status'] === 'interview' ? 'selected' : '' ?>>
                        Interview
                    </option>
                    <option value="rejected" <?= $values['status'] === 'rejected' ? 'selected' : '' ?>>
                        Rejected
                    </option>
                </select>
            </div>

            <div class="form-field">
                <label for="applied_at">Applied at</label>
                <input
                    type="date"
                    id="applied_at"
                    name="applied_at"
                    value="<?= escape($values['applied_at']) ?>"
                    required
                >
            </div>

            <p class="form-note">
                Validation preview - applications are not saved yet.
            </p>

            <button class="button" type="submit">
                Check application
            </button>
        </form>
    </main>

</body>
</html>