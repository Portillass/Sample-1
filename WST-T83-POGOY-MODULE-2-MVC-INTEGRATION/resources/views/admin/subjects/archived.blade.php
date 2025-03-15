@extends('layouts.sidebar')

@section('content')
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Archived Subjects</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('subjects.index') }}">Subjects</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Archived Subjects</li>
                            </ol>
                        </nav>
                    </div>
                </div>
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
                                    <form action="{{ route('subjects.restore', $subject) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-success">Restore</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No archived subjects found.</td>
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