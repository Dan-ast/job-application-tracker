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

        <form class="applications-panel application-form" action="/create.php" method="post">
            <div class="form-field">
                <label for="company">Company</label>
                <input type="text" id="company" name="company" max-length="255" required>
            </div>

            <div class="form-field">
                <label for="position">Position</label>
                <input type="text" id="position" name="position" max-length="255" required>
            </div>

            <div class="form-field">
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="applied">Applied</option>
                    <option value="interview">Interview</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>

            <div class="form-field">
                <label for="applied_at">Applied at</label>
                <input type="date" id="applied_at" name="applied_at" required>
            </div>

            <p class="form-note">
                Form preview - saving is not available yet.
            </p>

            <button class="button" type="submit" disabled>
                Save application
            </button>
        </form>
    </main>

</body>
</html>