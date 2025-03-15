<div class="modal fade" id="addSubjectsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Subjects for {{ $enrollment->first_name }} {{ $enrollment->last_name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                @if($subjects->isEmpty())
                    <div class="alert alert-info">
                        No available subjects for {{ strtoupper($enrollment->course) }} - Year {{ $enrollment->year_level }}, {{ $enrollment->semester == '1' ? 'First' : ($enrollment->semester == '2' ? 'Second' : 'Summer') }} Semester
                    </div>
                @else
                    <form action="{{ route('student.enroll-subjects', $enrollment) }}" method="POST" id="enrollSubjectForm">
                        @csrf
                        <div class="mb-3">
                            <label for="searchSubject" class="form-label">Search Subject</label>
                            <input type="text" class="form-control" id="searchSubject" placeholder="Search by code or name...">
                        </div>
                        
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-hover">
                                <thead class="sticky-top bg-white">
                                    <tr>
                                        <th>Select</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Units</th>
                                        <th>Schedule</th>
                                    </tr>
                                </thead>
                                <tbody id="subjectTableBody">
                                    @foreach($subjects as $subject)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" 
                                                        name="subjects[]" value="{{ $subject->id }}"
                                                        {{ $enrollment->subjects->contains($subject->id) ? 'disabled checked' : '' }}>
                                                </div>
                                            </td>
                                            <td>{{ strtoupper($subject->code) }}</td>
                                            <td>{{ $subject->name }}</td>
                                            <td>{{ $subject->units }}</td>
                                            <td>TBA</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Selected Subjects</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('searchSubject')?.addEventListener('keyup', function() {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#subjectTableBody tr');
    
    rows.forEach(row => {
        const code = row.children[1]?.textContent.toLowerCase() || '';
        const name = row.children[2]?.textContent.toLowerCase() || '';
        
        if (code.includes(searchValue) || name.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>
@endpush