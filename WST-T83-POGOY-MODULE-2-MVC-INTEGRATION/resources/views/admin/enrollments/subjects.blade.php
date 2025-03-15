@extends('layouts.sidebar')

@section('content')
<div class="body-wrapper">
    <div class="container-fluid">
        <!-- Page Title -->
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Student Subjects</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('enrollments.index') }}">Enrolled Students</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Student Subjects</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Info Card -->
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Student Information</h5>
                        <p><strong>Name:</strong> {{ $enrollment->first_name }} {{ $enrollment->middle_name }} {{ $enrollment->last_name }}</p>
                        <p><strong>Course:</strong> {{ strtoupper($enrollment->course) }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Year Level:</strong> {{ $enrollment->year_level }}</p>
                        <p><strong>Academic Year:</strong> {{ $enrollment->academic_year }}</p>
                        <p><strong>Semester:</strong> {{ $enrollment->semester }}</p>
                    </div>
                </div>
            </div>
        </div>

       <!-- Enrolled Subjects Card -->
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title">Enrolled Subjects</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubjectsModal">
                        <i class="ti ti-plus"></i> Add Subjects
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Subject Name</th>
                                <th>Units</th>
                                <th>Schedule</th>
                                <th>Midterm</th>
                                <th>Finals</th>
                                <th>Final Grade</th>
                                <th>Remarks</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($enrollment->subjects as $subject)
                            <tr>
                                <td>{{ strtoupper($subject->code) }}</td>
                                <td>{{ $subject->name }}</td>
                                <td>{{ $subject->units }}</td>
                                <td>TBA</td>
                                <td>{{ $subject->grade->midterm ?? '-' }}</td>
                                <td>{{ $subject->grade->finals ?? '-' }}</td>
                                <td>{{ $subject->grade->final_grade ?? '-' }}</td>
                                <td>{{ $subject->grade->remarks ?? '-' }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#gradeModal{{ $subject->id }}">
                                            Add Grade
                                        </button>
                                        <form action="{{ route('student.drop-subject', [$enrollment, $subject]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to drop this subject?')">
                                                Drop
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Grade Modal -->
                            <div class="modal fade" id="gradeModal{{ $subject->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add/Update Grade for {{ $subject->code }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ $subject->grade ? route('grades.update', $subject->grade) : route('grades.store', $enrollment) }}" method="POST">
                                            @csrf
                                            @if($subject->grade)
                                                @method('PUT')
                                            @endif
                                            <div class="modal-body">
                                                <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                                                <div class="mb-3">
                                                    <label for="midterm{{ $subject->id }}" class="form-label">Midterm Grade</label>
                                                    <input type="number" class="form-control" id="midterm{{ $subject->id }}" 
                                                        name="midterm" min="0" max="100" step="0.01" 
                                                        value="{{ $subject->grade->midterm ?? '' }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="finals{{ $subject->id }}" class="form-label">Finals Grade</label>
                                                    <input type="number" class="form-control" id="finals{{ $subject->id }}" 
                                                        name="finals" min="0" max="100" step="0.01" 
                                                        value="{{ $subject->grade->finals ?? '' }}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Save Grade</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">No subjects enrolled yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add Subjects Modal -->
        @include('admin.enrollments.partials.add-subjects-modal')
    </div>
</div>
@endsection
@push('scripts')
<script>
document.getElementById('searchSubject').addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('tbody tr');
    
    rows.forEach(row => {
        const code = row.children[1].textContent.toLowerCase();
        const name = row.children[2].textContent.toLowerCase();
        
        if (code.includes(searchValue) || name.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>
@endpush