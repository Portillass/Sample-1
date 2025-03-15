@extends('layouts.sidebar')

@section('content')
<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Student Enrollment Form</h5>
                <form method="POST" action="{{ route('enrollment.store') }}">
                    @csrf
                    <!-- Personal Information -->
                    <div class="mb-4">
                        <h6 class="fw-semibold">Personal Information</h6>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                    id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">This should match the student's login email</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="first_name" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="middleName" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="middleName" name="middle_name">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="last_name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="birthDate" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="birthDate" name="birth_date" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="contactNumber" class="form-label">Contact Number</label>
                                <input type="tel" class="form-control" id="contactNumber" name="contact_number" required>
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
                                    <option value="bscs">BS Computer Science</option>
                                    <option value="bsit">BS Information Technology</option>
                                    <option value="bsis">BS Information Systems</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="yearLevel" class="form-label">Year Level</label>
                                <select class="form-select" id="yearLevel" name="year_level" required>
                                    <option value="">Select Year Level</option>
                                    <option value="1">First Year</option>
                                    <option value="2">Second Year</option>
                                    <option value="3">Third Year</option>
                                    <option value="4">Fourth Year</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="semester" class="form-label">Semester</label>
                                <select class="form-select" id="semester" name="semester" required>
                                    <option value="">Select Semester</option>
                                    <option value="1">First Semester</option>
                                    <option value="2">Second Semester</option>
                                    <option value="summer">Summer</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="academicYear" class="form-label">Academic Year</label>
                                <select class="form-select" id="academicYear" name="academic_year" required>
                                    <option value="">Select Academic Year</option>
                                    <option value="2024-2025">2024-2025</option>
                                    <option value="2023-2024">2023-2024</option>
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
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="province" class="form-label">Province</label>
                                <input type="text" class="form-control" id="province" name="province" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="zipCode" class="form-label">Zip Code</label>
                                <input type="text" class="form-control" id="zipCode" name="zip_code" required>
                            </div>
                        </div>
                    </div>

                    <!-- Emergency Contact -->
                    <div class="mb-4">
                        <h6 class="fw-semibold">Emergency Contact</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="emergencyContact" class="form-label">Contact Person</label>
                                <input type="text" class="form-control" id="emergencyContact" name="emergency_contact" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="emergencyNumber" class="form-label">Contact Number</label>
                                <input type="tel" class="form-control" id="emergencyNumber" name="emergency_number" required>
                            </div>
                        </div>
                    </div>

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