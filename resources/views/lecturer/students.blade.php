@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Enrolled Students: {{ $course->code }} - {{ $course->name }}</h2>
        <a href="{{ route('lecturer.dashboard') }}" class="btn btn-secondary btn-sm">Back to Dashboard</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
    <thead>
        <tr>
            <th class="ps-4">#</th>
            <th>Student Name</th>
            <th>Student Number</th>
            <th>Registration Status</th>
        </tr>
    </thead>
    <tbody>
    @foreach($students as $index => $student)
        <tr>
            <td class="ps-4">{{ $index + 1 }}</td>
            <td>{{ $student->name ?? ($student->user->name ?? 'Student #' . $student->id) }}</td>
            <td>{{ $student->student_number }}</td>
            <td><span class="badge bg-success">Registered</span></td>
        </tr>
    @endforeach
</tbody>
</table>
            </div>
        </div>
    </div>
</div>
@endsection
