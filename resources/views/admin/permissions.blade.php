<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>System & Role Permissions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Role & Permission Management</h2>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i>Back to Dashboard</a>
        </div>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-dark text-white fw-bold">Active System Roles (Spatie Permission)</div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><strong>Admin</strong> - Full control over users, permissions, and records</span>
                        <span class="badge bg-danger">Assigned</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><strong>Lecturer</strong> - Manage course units, student rosters, and grades</span>
                        <span class="badge bg-info text-dark">Assigned</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span><strong>Student</strong> - View enrolled modules and academic records</span>
                        <span class="badge bg-primary">Assigned</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>