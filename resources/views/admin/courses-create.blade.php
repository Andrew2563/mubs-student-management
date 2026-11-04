<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MUBS SMS - Create Course Module</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">
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
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                
                <!-- Back Button -->
                <div class="mb-3">
                    <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted small">
                        <i class="bi bi-arrow-left me-1"></i>Back to Admin Dashboard
                    </a>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-info text-dark fw-bold py-3">
                        <i class="bi bi-journal-plus me-2"></i>Create Course Module
                    </div>
                    <div class="card-body p-4">

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('admin.courses.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="code" class="form-label fw-medium">Course Code</label>
                                <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}" placeholder="e.g. BUC3131" required>
                                <div class="form-text text-muted small">Must be unique (e.g., BUC3131, BUC3127).</div>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label fw-medium">Course Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. Advanced Web Application Development" required>
                            </div>

                            <div class="mb-4">
                                <label for="credits" class="form-label fw-medium">Credit Units</label>
                                <input type="number" class="form-control" id="credits" name="credits" value="{{ old('credits') }}" min="1" max="10" placeholder="e.g. 4" required>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-info text-dark fw-bold py-2">
                                    <i class="bi bi-check-circle-fill me-1"></i>Save Course Module
                                </button>
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-light text-muted py-2">Cancel</a>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>