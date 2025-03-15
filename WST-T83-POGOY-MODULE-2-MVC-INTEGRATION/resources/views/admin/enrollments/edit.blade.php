@extends('layouts.sidebar')
@section('title')
Edit Student Enrollment
@endsection
@section('content')
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Edit Student Enrollment</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('enrollments.index') }}">Enrolled Students</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Student</li>
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
                <form method="POST" action="{{ route('enrollments.update', $enrollment) }}">
                    @csrf
                    @method('PUT')
                    
                    <!-- Personal Information -->
                    <div class="mb-4">
                        <h6 class="fw-semibold">Personal Information</h6>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                    id="email" name="email" 
                                    value="{{ old('email', $enrollment->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">This should match the student's login email</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="first_name" 
                                    value="{{ old('first_name', $enrollment->first_name) }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="middleName" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="middleName" name="middle_name"
                                    value="{{ old('middle_name', $enrollment->middle_name) }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="last_name"
                                    value="{{ old('last_name', $enrollment->last_name) }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="birthDate" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="birthDate" name="birth_date"
                                    value="{{ old('birth_date', $enrollment->birth_date) }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender', $enrollment->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $enrollment->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender', $enrollment->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="contactNumber" class="form-label">Contact Number</label>
                                <input type="tel" class="form-control" id="contactNumber" name="contact_number"
                                    value="{{ old('contact_number', $enrollment->contact_number) }}" required>
                            </div>
                        </div>
                    </div>

                    <!-- Academic Information -->
                    <div class="mb-4">
                        <h6 class="fw-semibold">Academic Information</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="course" class="form-label">Course</label>
                                <select class="form-select" id="course" name="course" required>
                                    <option value="">Select Course</option>
                                    <option value="bscs" {{ old('course', $enrollment->course) == 'bscs' ? 'selected' : '' }}>BS Computer Science</option>
                                    <option value="bsit" {{ old('course', $enrollment->course) == 'bsit' ? 'selected' : '' }}>BS Information Technology</option>
                                    <option value="bsis" {{ old('course', $enrollment->course) == 'bsis' ? 'selected' : '' }}>BS Information Systems</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="yearLevel" class="form-label">Year Level</label>
                                <select class="form-select" id="yearLevel" name="year_level" required>
                                    <option value="">Select Year Level</option>
                                    @for($i = 1; $i <= 4; $i++)
                                        <option value="{{ $i }}" {{ old('year_level', $enrollment->year_level) == $i ? 'selected' : '' }}>
                                            {{ $i }}st Year
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="semester" class="form-label">Semester</label>
                                <select class="form-select" id="semester" name="semester" required>
                                    <option value="">Select Semester</option>
                                    <option value="1" {{ old('semester', $enrollment->semester) == '1' ? 'selected' : '' }}>First Semester</option>
                                    <option value="2" {{ old('semester', $enrollment->semester) == '2' ? 'selected' : '' }}>Second Semester</option>
                                    <option value="summer" {{ old('semester', $enrollment->semester) == 'summer' ? 'selected' : '' }}>Summer</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="academicYear" class="form-label">Academic Year</label>
                                <select class="form-select" id="academicYear" name="academic_year" required>
                                    <option value="">Select Academic Year</option>
                                    <option value="2024-2025" {{ old('academic_year', $enrollment->academic_year) == '2024-2025' ? 'selected' : '' }}>2024-2025</option>
                                    <option value="2023-2024" {{ old('academic_year', $enrollment->academic_year) == '2023-2024' ? 'selected' : '' }}>2023-2024</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Address Information -->
                    <div class="mb-4">
                        <h6 class="fw-semibold">Address Information</h6>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="address" class="form-label">Street Address</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ old('address', $enrollment->address) }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city"
                                    value="{{ old('city', $enrollment->city) }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="province" class="form-label">Province</label>
                                <input type="text" class="form-control" id="province" name="province"
                                    value="{{ old('province', $enrollment->province) }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="zipCode" class="form-label">Zip Code</label>
                                <input type="text" class="form-control" id="zipCode" name="zip_code"
                                    value="{{ old('zip_code', $enrollment->zip_code) }}" required>
                            </div>
                        </div>
                    </div>

                    <!-- Emergency Contact -->
                    <div class="mb-4">
                        <h6 class="fw-semibold">Emergency Contact</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="emergencyContact" class="form-label">Contact Person</label>
                                <input type="text" class="form-control" id="emergencyContact" name="emergency_contact"
                                    value="{{ old('emergency_contact', $enrollment->emergency_contact) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="emergencyNumber" class="form-label">Contact Number</label>
                                <input type="tel" class="form-control" id="emergencyNumber" name="emergency_number"
                                    value="{{ old('emergency_number', $enrollment->emergency_number) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Enrollment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection