@extends('layouts.sidebar')

@section('content')
<div class="body-wrapper">
    <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
            <!-- Yearly Statistics Card -->
            <div class="col-lg-4">
                <div class="card overflow-hidden">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Yearly Statistics</h5>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="fw-semibold mb-3">{{ $currentYearCount }}</h4>
                                <div class="d-flex align-items-center mb-3">
                                    <span class="me-1 rounded-circle bg-light-{{ $percentageChange >= 0 ? 'success' : 'danger' }} round-20 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-arrow-{{ $percentageChange >= 0 ? 'up' : 'down' }}-left text-{{ $percentageChange >= 0 ? 'success' : 'danger' }}"></i>
                                    </span>
                                    <p class="text-dark me-1 fs-3 mb-0">{{ number_format($percentageChange, 1) }}%</p>
                                    <p class="fs-3 mb-0">last year</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Students Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-start">
                            <div class="col-8">
                                <h5 class="card-title mb-9 fw-semibold">Total Students</h5>
                                <h4 class="fw-semibold mb-3">{{ $totalStudents }}</h4>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-end">
                                    <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-users fs-6"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Enrollments -->
        <div class="row">
            <div class="col-lg-4 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold">Recent Enrollments</h5>
                        <ul class="timeline-widget mb-0 position-relative mb-n5">
                            @foreach($recentEnrollments as $enrollment)
                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                <div class="timeline-time text-dark flex-shrink-0 text-end">
                                    {{ $enrollment->created_at->format('H:i') }}
                                </div>
                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                    <span class="timeline-badge border-2 border border-primary flex-shrink-0 my-8"></span>
                                    <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                </div>
                                <div class="timeline-desc fs-3 text-dark mt-n1">
                                    New enrollment: {{ $enrollment->first_name }} {{ $enrollment->last_name }} - {{ strtoupper($enrollment->course) }}
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Latest Enrolled Students Table -->
            <div class="col-lg-8 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-semibold mb-4">Latest Enrolled Students</h5>
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0"><h6 class="fw-semibold mb-0">ID</h6></th>
                                        <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Student Name</h6></th>
                                        <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Course</h6></th>
                                        <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Year Level</h6></th>
                                        <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Status</h6></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($latestStudents as $student)
                                    <tr>
                                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $student->id }}</h6></td>
                                        <td class="border-bottom-0">
                                            <h6 class="fw-semibold mb-1">{{ $student->first_name }} {{ $student->last_name }}</h6>
                                            <span class="fw-normal">{{ date('Y') }}-{{ str_pad($student->id, 4, '0', STR_PAD_LEFT) }}</span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ strtoupper($student->course) }}</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <p class="mb-0 fw-normal">{{ $student->year_level }} Year</p>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="badge bg-success rounded-3 fw-semibold">Enrolled</span>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Course Statistics -->
        <div class="row">
            @foreach($courseEnrollments as $course)
            <div class="col-sm-6 col-xl-3">
                <div class="card overflow-hidden rounded-2">
                    <div class="card-body">
                        <h5 class="fw-semibold mb-4">{{ strtoupper($course->course) }}</h5>
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="fw-semibold mb-2">{{ $course->total }}</h3>
                                <span class="text-muted fs-3">Students Enrolled</span>
                            </div>
                            <i class="ti ti-device-laptop fs-7 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection