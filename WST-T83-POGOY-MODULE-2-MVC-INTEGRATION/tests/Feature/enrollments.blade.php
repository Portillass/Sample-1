@extends('layouts.sidebar')

@section('content')
<div class="body-wrapper">
    <div class="container-fluid">
        <!-- Page Title -->
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <h4 class="fw-semibold mb-8">Enrollment Requests</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-muted" href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Enrollment Requests</li>
                    </ol>
                </nav>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Enrollment Requests Table -->
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
                                <th>Date Applied</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enrollments as $enrollment)
                            <tr>
                                <td>{{ $enrollment->id }}</td>
                                <td>
                                    {{ $enrollment->first_name }} {{ $enrollment->middle_name }} {{ $enrollment->last_name }}
                                    <br>
                                    <small class="text-muted">{{ $enrollment->contact_number }}</small>
                                </td>
                                <td>{{ $enrollment->course }}</td>
                                <td>{{ $enrollment->year_level }}</td>
                                <td>{{ $enrollment->created_at->format('M d, Y') }}</td>
                                <td>
                                    @if($enrollment->status === 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($enrollment->status === 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @else
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewModal{{ $enrollment->id }}">
                                        View
                                    </button>
                                    @if($enrollment->status === 'pending')
                                        <form action="{{ route('enrollment.approve', $enrollment) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                        </form>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $enrollment->id }}">
                                            Reject
                                        </button>
                                    @endif
                                </td>
                            </tr>

                            <!-- View Modal -->
                            <div class="modal fade" id="viewModal{{ $enrollment->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Enrollment Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <h6>Personal Information</h6>
                                                    <p><strong>Name:</strong> {{ $enrollment->first_name }} {{ $enrollment->middle_name }} {{ $enrollment->last_name }}</p>
                                                    <p><strong>Birth Date:</strong> {{ $enrollment->birth_date }}</p>
                                                    <p><strong>Gender:</strong> {{ $enrollment->gender }}</p>
                                                    <p><strong>Contact:</strong> {{ $enrollment->contact_number }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6>Academic Information</h6>
                                                    <p><strong>Course:</strong> {{ $enrollment->course }}</p>
                                                    <p><strong>Year Level:</strong> {{ $enrollment->year_level }}</p>
                                                    <p><strong>Semester:</strong> {{ $enrollment->semester }}</p>
                                                    <p><strong>Academic Year:</strong> {{ $enrollment->academic_year }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h6>Address</h6>
                                                    <p>{{ $enrollment->address }}, {{ $enrollment->city }}, {{ $enrollment->province }} {{ $enrollment->zip_code }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reject Modal -->
                            <div class="modal fade" id="rejectModal{{ $enrollment->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('enrollment.reject', $enrollment) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Reject Enrollment</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="remarks" class="form-label">Reason for Rejection</label>
                                                    <textarea class="form-control" id="remarks" name="remarks" rows="3" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Reject Enrollment</button>
                                            </div>
                                        </form>
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
@endsection