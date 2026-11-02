<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Dashboard - MUBS Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-slate-50 font-sans text-slate-800 antialiased">

    <!-- Top Navigation Header -->
    <nav class="bg-blue-700 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-white text-blue-700 font-bold p-2 rounded-lg text-lg">MUBS</div>
                <h1 class="text-xl font-bold tracking-wide">Lecturer Portal</h1>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-sm bg-blue-800 px-3 py-1.5 rounded-full border border-blue-500/30">
                    <i class="fa-solid fa-user-tie mr-1.5"></i> {{ auth()->user()->email ?? 'lecturer1@mubs.ac.ug' }}
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3.5 py-1.5 rounded-md text-sm font-medium transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Main Content Container -->
    <main class="max-w-7xl mx-auto px-6 py-8">

        <!-- Banner Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-900">Course Management</h2>
                <p class="text-slate-500 text-sm mt-1">Manage your assigned teaching modules, view enrolled students, and record marks.</p>
            </div>
            <div>
                <a href="/auto-seed-data" class="inline-flex items-center bg-indigo-50 text-indigo-700 hover:bg-indigo-100 font-medium px-4 py-2 rounded-lg text-sm border border-indigo-200 transition">
                    <i class="fa-solid fa-database mr-2"></i> Auto-Seed Test Data
                </a>
            </div>
        </div>

        <!-- Success Message Alert -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-lg shadow-sm flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fa-solid fa-circle-check text-emerald-500 text-lg mr-3"></i>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Courses Table Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-100/75 border-b border-slate-200 text-slate-600 text-xs font-semibold uppercase tracking-wider">
                            <th class="py-4 px-6">Course Code</th>
                            <th class="py-4 px-6">Course Name</th>
                            <th class="py-4 px-6 text-center">Credit Units</th>
                            <th class="py-4 px-6 text-center">Enrolled Students</th>
                            <th class="py-4 px-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($courses as $course)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-4 px-6 font-semibold text-emerald-700">
                                    {{ $course->code ?? $course->course_code }}
                                </td>
                                <td class="py-4 px-6 font-medium text-slate-900">
                                    {{ $course->name ?? $course->course_name }}
                                </td>
                                <td class="py-4 px-6 text-center text-slate-600">
                                    <span class="bg-slate-100 text-slate-700 px-2.5 py-1 rounded-md text-xs font-medium">
                                        {{ $course->credit_units ?? 3 }} CU
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <span class="inline-flex items-center justify-center px-3 py-1 text-xs font-bold rounded-full bg-blue-50 text-blue-700 border border-blue-200">
                                        {{ $course->students_count ?? $course->registrations_count ?? 0 }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a href="/lecturer/courses/{{ $course->id }}/students" 
                                           class="inline-flex items-center px-3 py-1.5 bg-sky-500 hover:bg-sky-600 text-white rounded-md text-xs font-semibold shadow-sm transition">
                                            <i class="fa-solid fa-users mr-1.5"></i> View Students
                                        </a>
                                        <a href="/lecturer/courses/{{ $course->id }}/marks" 
                                           class="inline-flex items-center px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-md text-xs font-semibold shadow-sm transition">
                                            <i class="fa-solid fa-pen-to-square mr-1.5"></i> Enter Marks
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 px-6 text-center text-slate-400">
                                    No courses currently assigned to your profile.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>

</body>
</html>