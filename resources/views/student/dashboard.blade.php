@extends('layouts.app')

@section('title', 'Student Dashboard - MUBS')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        
        <!-- Student Details Card -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Student Profile</h4>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                <p><strong>Registration Number:</strong> {{ $student->registration_number }}</p>
                <p><strong>Student Number:</strong> {{ $student->student_number }}</p>
                <p><strong>Program:</strong> {{ $student->program }}</p>
            </div>
        </div>

        <!-- Registered Courses Section -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">My Registered Courses (2026/2027)</h4>
            </div>
            <div class="card-body">
                @if($registeredCourses->isEmpty())
                    <p class="text-muted">No courses registered yet.</p>
                @else
                    <ul class="list-group">
                        @foreach($registeredCourses as $reg)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $reg->course->course_code ?? $reg->course->code }}:</strong> 
                                    {{ $reg->course->course_name ?? $reg->course->name ?? $reg->course->title ?? 'Course Name' }}
                                </div>
                                <span class="badge bg-primary rounded-pill">
                                    {{ $reg->course->credit_units ?? $reg->course->credits ?? 3 }} CU
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <!-- Course Registration Form -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Register for Available Courses</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('student.register.course') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="course_id" class="form-label">Select Course</label>
                        <select name="course_id" id="course_id" class="form-select @error('course_id') is-invalid @enderror" required>
                            <option value="">-- Select a course --</option>
                            @foreach($allCourses as $course)
                                <option value="{{ $course->id }}">
                                    {{ $course->course_code ?? $course->code }} - {{ $course->course_name ?? $course->name ?? $course->title }} ({{ $course->credit_units ?? $course->credits ?? 3 }} CU)
                                </option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Submit Registration</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection