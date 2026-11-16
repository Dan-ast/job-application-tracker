CREATE TABLE IF NOT EXISTS applications (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    company TEXT NOT NULL
        CHECK (length(trim(company)) BETWEEN 1 AND 255),
    position TEXT NOT NULL
        CHECK (length(trim(position)) BETWEEN 1 AND 255),
    status TEXT NOT NULL DEFAULT 'applied'
        CHECK (status IN ('applied', 'interview', 'rejected')),
    applied_at TEXT NOT NULL
        CHECK (
            applied_at GLOB
            '[0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9]'
        ),
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX IF NOT EXISTS idx_applications_status
    ON applications (status);

CREATE INDEX IF NOT EXISTS idx_applications_applied_at
    ON applications (applied_at);