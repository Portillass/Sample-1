@extends('layouts.sidebar')

@section('content')
<div class="body-wrapper">
    <div class="container-fluid">
        <!-- Page Title -->
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Subjects</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Subjects</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3">
                        <div class="text-end mb-3">
                            <a href="{{ route('subjects.create') }}" class="btn btn-primary">
                                <i class="ti ti-plus"></i> Add Subject
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <form action="{{ route('subjects.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search subjects..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('subjects.archived') }}" class="btn btn-secondary">
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
                                <th>Code</th>
                                <th>Name</th>
                                <th>Units</th>
                                <th>Course</th>
                                <th>Year Level</th>
                                <th>Semester</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subjects as $subject)
                            <tr>
                                <td>{{ strtoupper($subject->code) }}</td>
                                <td>{{ $subject->name }}</td>
                                <td>{{ $subject->units }}</td>
                                <td>{{ strtoupper($subject->course) }}</td>
                                <td>{{ $subject->year_level }}</td>
                                <td>{{ $subject->semester }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#viewModal{{ $subject->id }}">
                                            View
                                        </button>
                                        <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-sm btn-warning">
                                            Edit
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#archiveModal{{ $subject->id }}">
                                            Archive
                                        </button>
                                    </div>
                                </td>
                            </tr>

                           <!-- View Modal -->
                            <div class="modal fade" id="viewModal{{ $subject->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Subject Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6 class="fw-semibold">Basic Information</h6>
                                                    <p><strong>Code:</strong> {{ strtoupper($subject->code) }}</p>
                                                    <p><strong>Name:</strong> {{ $subject->name }}</p>
                                                    <p><strong>Units:</strong> {{ $subject->units }}</p>
                                                    <p><strong>Description:</strong> {{ $subject->description ?? 'No description available' }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6 class="fw-semibold">Academic Details</h6>
                                                    <p><strong>Course:</strong> {{ strtoupper($subject->course) }}</p>
                                                    <p><strong>Year Level:</strong> {{ $subject->year_level }}</p>
                                                    <p><strong>Semester:</strong> 
                                                        @if($subject->semester == '1')
                                                            First Semester
                                                        @elseif($subject->semester == '2')
                                                            Second Semester
                                                        @else
                                                            Summer
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Archive Modal -->
                            <div class="modal fade" id="archiveModal{{ $subject->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Archive Subject</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to archive this subject?</p>
                                            <p><strong>{{ $subject->code }} - {{ $subject->name }}</strong></p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('subjects.archive', $subject) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Archive</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No subjects found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $subjects->links() }}
            </div>
        </div>
    </div>
</div>
@endsection