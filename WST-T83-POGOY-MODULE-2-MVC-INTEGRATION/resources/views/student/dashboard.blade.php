@extends('layouts.sidebar')

@section('title', 'Student Dashboard')

@section('content')
<div class="body-wrapper">
    <div class="container-fluid">
        <!-- Page Title -->
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Student Dashboard</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">My Subjects</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Info Card -->
        @if($enrollment)
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Student Information</h5>
                        <p><strong>Name:</strong> {{ $enrollment->first_name }} {{ $enrollment->middle_name }} {{ $enrollment->last_name }}</p>
                        <p><strong>Course:</strong> {{ strtoupper($enrollment->course) }}</p>
                        <p><strong>Student ID:</strong> {{ auth()->user()->id }}</p>
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
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">My Subjects</h5>
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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subjects as $subject)
                            <tr>
                                <td>{{ strtoupper($subject->code) }}</td>
                                <td>{{ $subject->name }}</td>
                                <td>{{ $subject->units }}</td>
                                <td>TBA</td>
                                @php
                                    $grade = $subject->grades->first();
                                @endphp
                                <td>{{ $grade ? $grade->midterm : '-' }}</td>
                                <td>{{ $grade ? $grade->finals : '-' }}</td>
                                <td>{{ $grade ? $grade->final_grade : '-' }}</td>
                                <td>{{ $grade ? $grade->remarks : '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">No subjects enrolled yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @else
        <div class="card">
            <div class="card-body text-center">
                <h5>No enrollment found</h5>
                <p>Please contact the administration office.</p>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection