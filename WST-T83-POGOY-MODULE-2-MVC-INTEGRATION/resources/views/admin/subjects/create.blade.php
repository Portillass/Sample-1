@extends('layouts.sidebar')

@section('content')
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Add New Subject</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('subjects.index') }}">Subjects</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add New Subject</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('subjects.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="code" class="form-label">Subject Code</label>
                        <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Subject Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="units" class="form-label">Units</label>
                        <input type="number" class="form-control" id="units" name="units" value="{{ old('units') }}" required min="1" max="6">
                    </div>

                    <div class="mb-3">
                        <label for="course" class="form-label">Course</label>
                        <select class="form-select" id="course" name="course" required>
                            <option value="">Select Course</option>
                            <option value="bscs" {{ old('course') == 'bscs' ? 'selected' : '' }}>BS Computer Science</option>
                            <option value="bsit" {{ old('course') == 'bsit' ? 'selected' : '' }}>BS Information Technology</option>
                            <option value="bsis" {{ old('course') == 'bsis' ? 'selected' : '' }}>BS Information Systems</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="year_level" class="form-label">Year Level</label>
                        <select class="form-select" id="year_level" name="year_level" required>
                            <option value="">Select Year Level</option>
                            <option value="1" {{ old('year_level') == '1' ? 'selected' : '' }}>First Year</option>
                            <option value="2" {{ old('year_level') == '2' ? 'selected' : '' }}>Second Year</option>
                            <option value="3" {{ old('year_level') == '3' ? 'selected' : '' }}>Third Year</option>
                            <option value="4" {{ old('year_level') == '4' ? 'selected' : '' }}>Fourth Year</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="semester" class="form-label">Semester</label>
                        <select class="form-select" id="semester" name="semester" required>
                            <option value="">Select Semester</option>
                            <option value="1" {{ old('semester') == '1' ? 'selected' : '' }}>First Semester</option>
                            <option value="2" {{ old('semester') == '2' ? 'selected' : '' }}>Second Semester</option>
                            <option value="summer" {{ old('semester') == 'summer' ? 'selected' : '' }}>Summer</option>
                        </select>
                    </div>

                    <div class="text-end">
                        <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Create Subject</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection