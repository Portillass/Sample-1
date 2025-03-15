@extends('layouts.sidebar')

@section('content')
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Student Enrollment Form</h5>
                <form method="POST" action="{{ route('enrollment.store') }}">
                    @csrf
                    @include('admin.enrollments.enrollment_form')
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Submit Enrollment</button>
                        <button type="reset" class="btn btn-secondary">Reset Form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection