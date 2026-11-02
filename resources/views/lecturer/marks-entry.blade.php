<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Marks - MUBS Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-slate-50 font-sans text-slate-800 antialiased">

    <!-- Header -->
    <nav class="bg-blue-700 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="bg-white text-blue-700 font-bold p-2 rounded-lg text-lg">MUBS</div>
                <h1 class="text-xl font-bold tracking-wide">Lecturer Portal</h1>
            </div>
            <a href="/lecturer/dashboard" class="bg-blue-800 hover:bg-blue-900 text-white px-3.5 py-1.5 rounded-md text-sm font-medium transition flex items-center">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back to Dashboard
            </a>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-6 py-8">

        <!-- Banner -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-8 flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
                    {{ $course->code ?? 'BUC3131' }}
                </span>
                <h2 class="text-2xl font-bold text-slate-900 mt-2">{{ $course->name ?? 'Advanced Web Application Development' }}</h2>
                <p class="text-slate-500 text-sm mt-0.5">Enter coursework and final exam scores for enrolled students.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-lg shadow-sm flex items-center">
                <i class="fa-solid fa-circle-check text-emerald-500 text-lg mr-3"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Form Table -->
        <form method="POST" action="/lecturer/courses/{{ $course->id ?? 1 }}/marks">
            @csrf
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-100/75 border-b border-slate-200 text-slate-600 text-xs font-semibold uppercase tracking-wider">
                            <th class="py-4 px-6">#</th>
                            <th class="py-4 px-6">Student Name</th>
                            <th class="py-4 px-6 text-center">Coursework (40)</th>
                            <th class="py-4 px-6 text-center">Exam (60)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
    @forelse($students as $index => $student)
        <tr class="hover:bg-slate-50/80 transition-colors">
            <td class="py-4 px-6 font-medium text-slate-400">{{ $index + 1 }}</td>

            <!-- ADD THIS LINE BELOW TO SHOW THE STUDENT NAME -->
            <td class="py-4 px-6 font-semibold text-slate-800">{{ $student->name ?? ($student->user->name ?? 'Student #' . $student->id) }}</td>

            <td class="py-4 px-6">{{ $student->student_number }}</td>
            <td class="py-4 px-6 text-center">
                <input type="number" name="marks[{{ $student->id }}][coursework]" class="w-24 px-3 py-1.5 text-center border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="e.g. 28">
            </td>
            <td class="py-4 px-6 text-center">
                <input type="number" name="marks[{{ $student->id }}][exam]" class="w-24 px-3 py-1.5 text-center border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="e.g. 45">
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="py-6 text-center text-slate-500">No students found registered for this course.</td>
        </tr>
                        @endforelse
                    </tbody>
                </table>

                @if(count($students) > 0)
                    <div class="p-6 bg-slate-50/50 border-t border-slate-200 flex justify-end">
                        <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-semibold shadow-sm transition">
                            <i class="fa-solid fa-floppy-disk mr-2"></i> Save All Marks
                        </button>
                    </div>
                @endif
            </div>
        </form>

    </main>

</body>
</html>
