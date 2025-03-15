@extends('layouts.sidebar')

@section('content')
<div class="body-wrapper">
    <div class="container-fluid">
        <!-- Page Title -->
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Enrolled Students</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Enrolled Students</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3">
                        <div class="text-end mb-3">
                            <a href="{{ route('enrollment.create') }}" class="btn btn-primary">
                                <i class="ti ti-plus"></i> Enroll New Student
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <!-- Search and Archive buttons -->
         <div class="row mb-3">
            <div class="col-md-6">
                <form action="{{ route('enrollments.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search students..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('enrollments.archived') }}" class="btn btn-secondary">
                    <i class="ti ti-archive"></i> View Archived
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Student Name</th>
                                <th>Course</th>
                                <th>Year Level</th>
                                <th>Contact</th>
                                <th>Date Enrolled</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enrollments as $enrollment)
                            <tr>
                                <td>{{ $enrollment->id }}</td>
                                <td>{{ $enrollment->first_name }} {{ $enrollment->middle_name }} {{ $enrollment->last_name }}</td>
                                <td>{{ strtoupper($enrollment->course) }}</td>
                                <td>{{ $enrollment->year_level }}</td>
                                <td>{{ $enrollment->contact_number }}</td>
                                <td>{{ $enrollment->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewModal{{ $enrollment->id }}">
                                            View
                                        </button>
                                        <a href="{{ route('enrollments.edit', $enrollment) }}" class="btn btn-sm btn-warning">
                                            Edit
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#archiveModal{{ $enrollment->id }}">
                                            Archive
                                        </button>
                                        <a href="{{ route('student.subjects', $enrollment) }}" class="btn btn-sm btn-success">
                                            <i class="ti ti-book"></i> Manage Subjects
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- View Modal -->
                            <div class="modal fade" id="viewModal{{ $enrollment->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Student Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6 class="fw-semibold">Personal Information</h6>
                                                    <p><strong>Name:</strong> {{ $enrollment->first_name }} {{ $enrollment->middle_name }} {{ $enrollment->last_name }}</p>
                                                    <p><strong>Birth Date:</strong> {{ $enrollment->birth_date }}</p>
                                                    <p><strong>Gender:</strong> {{ $enrollment->gender }}</p>
                                                    <p><strong>Contact:</strong> {{ $enrollment->contact_number }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 class="fw-semibold">Academic Information</h6>
                                                    <p><strong>Course:</strong> {{ strtoupper($enrollment->course) }}</p>
                                                    <p><strong>Year Level:</strong> {{ $enrollment->year_level }}</p>
                                                    <p><strong>Semester:</strong> {{ $enrollment->semester }}</p>
                                                    <p><strong>Academic Year:</strong> {{ $enrollment->academic_year }}</p>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <h6 class="fw-semibold">Address</h6>
                                                    <p>{{ $enrollment->address }}, {{ $enrollment->city }}, {{ $enrollment->province }} {{ $enrollment->zip_code }}</p>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-md-12">
                                                    <h6 class="fw-semibold">Emergency Contact</h6>
                                                    <p><strong>Name:</strong> {{ $enrollment->emergency_contact }}</p>
                                                    <p><strong>Contact:</strong> {{ $enrollment->emergency_number }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Archive Modal -->
                                <div class="modal fade" id="archiveModal{{ $enrollment->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Archive Student</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to archive this student?</p>
                                                <p><strong>{{ $enrollment->first_name }} {{ $enrollment->last_name }}</strong></p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('enrollments.archive', $enrollment) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Archive</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Enroll Subject Modal -->
                                    <div class="modal fade" id="enrollSubjectModal{{ $enrollment->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Enroll Subject for {{ $enrollment->first_name }} {{ $enrollment->last_name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('student.enroll-subjects', $enrollment) }}" method="POST" id="enrollSubjectForm{{ $enrollment->id }}">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="searchSubject{{ $enrollment->id }}" class="form-label">Search Subject</label>
                                                            <input type="text" class="form-control" id="searchSubject{{ $enrollment->id }}" 
                                                                placeholder="Search by code or name...">
                                                        </div>
                                                        
                                                        <!-- <div class="mb-3">
                                                            <label class="form-label">Available Subjects</label>
                                                            <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                                                                <table class="table table-hover">
                                                                    <thead class="sticky-top bg-white">
                                                                        <tr>
                                                                            <th>Select</th>
                                                                            <th>Code</th>
                                                                            <th>Name</th>
                                                                            <th>Units</th>
                                                                            <th>Schedule</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="subject-list" id="subjectList{{ $enrollment->id }}">
                                                                        @foreach($subjects ?? [] as $subject)
                                                                        <tr>
                                                                            <td>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" 
                                                                                        name="subjects[]" value="{{ $subject->id }}"
                                                                                        id="subject{{ $enrollment->id }}_{{ $subject->id }}">
                                                                                </div>
                                                                            </td>
                                                                            <td>{{ strtoupper($subject->code) }}</td>
                                                                            <td>{{ $subject->name }}</td>
                                                                            <td>{{ $subject->units }}</td>
                                                                            <td>TBA</td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div> -->
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" form="enrollSubjectForm{{ $enrollment->id }}" class="btn btn-primary">
                                                        Enroll Selected Subjects
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $enrollments->links() }}
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
document.querySelectorAll('[id^="searchSubject"]').forEach(input => {
    input.addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const enrollmentId = this.id.replace('searchSubject', '');
        const rows = document.querySelectorAll(`#subjectList${enrollmentId} tr`);
        
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
});
</script>
@endpush
@endsection