<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Lecturer Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-success text-white fw-bold">Add Lecturer Account</div>
                    <div class="card-body">
                        <form action="{{ route('admin.lecturers.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Lecturer Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter lecturer's name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="lecturer@mubs.ac.ug" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Department</label>
                                <input type="text" name="department" class="form-control" placeholder="e.g. Department of Computing" required>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
                                <button type="submit" class="btn btn-success">Save Lecturer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>