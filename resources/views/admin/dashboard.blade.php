<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUBS SMS - Administrator Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-shield-lock-fill me-2"></i>MUBS Student Management System
            </a>
            <div class="d-flex align-items-center">
                <span class="text-white me-3">
                    <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }} (Administrator)
                </span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-box-arrow-right me-1"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content Container -->
    <div class="container-fluid px-4 py-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-dark mb-0">System Administration Dashboard</h2>
                <p class="text-muted small">Manage university users, courses, system roles, and academic records.</p>
            </div>
            <span class="badge bg-success fs-6 py-2 px-3">Active Academic Session 2026/2027</span>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Metric Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm border-start border-4 border-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-muted fw-bold small">Total Users</h6>
                                <h3 class="fw-bold mb-0">{{ $users->count() }}</h3>
                            </div>
                            <div class="bg-primary-subtle text-primary p-3 rounded-circle">
                                <i class="bi bi-people-fill fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm border-start border-4 border-success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-muted fw-bold small">Total Lecturers</h6>
                                <h3 class="fw-bold mb-0">85</h3>
                            </div>
                            <div class="bg-success-subtle text-success p-3 rounded-circle">
                                <i class="bi bi-person-badge-fill fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm border-start border-4 border-info">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-muted fw-bold small">Course Modules</h6>
                                <h3 class="fw-bold mb-0">{{ $courses->count() }}</h3>
                            </div>
                            <div class="bg-info-subtle text-info p-3 rounded-circle">
                                <i class="bi bi-journal-bookmark-fill fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 shadow-sm border-start border-4 border-warning">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-muted fw-bold small">System Roles</h6>
                                <h3 class="fw-bold mb-0">3 Active</h3>
                            </div>
                            <div class="bg-warning-subtle text-warning p-3 rounded-circle">
                                <i class="bi bi-shield-check fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Administrative Responsibilities & Action Panels -->
        <div class="row g-4">
            
            <!-- Quick Actions -->
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-dark text-white fw-bold">
                        <i class="bi bi-gear-fill me-2"></i>Admin Actions
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.students.create') }}" class="btn btn-outline-primary text-start py-2">
                                <i class="bi bi-person-plus-fill me-2"></i>Register New Student
                            </a>
                            <a href="{{ route('admin.lecturers.create') }}" class="btn btn-outline-success text-start py-2">
                                <i class="bi bi-person-workspace me-2"></i>Add Lecturer Account
                            </a>
                            <a href="{{ route('admin.courses.create') }}" class="btn btn-outline-info text-start py-2">
                                <i class="bi bi-journal-plus me-2"></i>Create Course Module
                            </a>
                            <a href="{{ route('admin.permissions') }}" class="btn btn-outline-secondary text-start py-2">
                                <i class="bi bi-sliders me-2"></i>System & Role Permissions
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dynamic System Users Activity Table -->
            <div class="col-md-8">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white fw-bold py-3">
                        <i class="bi bi-list-check me-2 text-primary"></i>System Users & Registered Activity
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td class="fw-medium">{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @foreach($user->roles as $role)
                                                <span class="badge bg-{{ $role->name == 'admin' ? 'danger' : ($role->name == 'lecturer' ? 'info' : 'primary') }}">
                                                    {{ ucfirst($role->name) }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td><span class="badge bg-success-subtle text-success">Active</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Registered Course Modules Table -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white fw-bold py-3">
                        <i class="bi bi-journal-bookmark-fill me-2 text-info"></i>Registered Course Modules
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Course Code</th>
                                        <th>Course Name</th>
                                        <th>Credit Units</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($courses as $course)
                                    <tr>
                                        <td class="fw-bold text-primary">{{ $course->code }}</td>
                                        <td>{{ $course->name }}</td>
                                        <td><span class="badge bg-info text-dark">{{ $course->credits }} CU</span></td>
                                        <td><span class="badge bg-success-subtle text-success">Active</span></td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-3">No course modules registered yet.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>