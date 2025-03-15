@extends('layouts.sidebar')

@section('title', 'Not Enrolled')

@section('content')
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Student Dashboard</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Not Enrolled</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="ti ti-alert-circle text-warning" style="font-size: 48px;"></i>
                        <h3 class="mt-3">Not Currently Enrolled</h3>
                        <p class="text-muted">{{ $message }}</p>
                        <p>Please contact the administration office for enrollment information.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection