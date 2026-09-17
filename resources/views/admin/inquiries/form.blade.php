@php
    $inquiry = $inquiry ?? null;
@endphp

<div class="form-group">
    <label>Link to Lead</label>
    <select name="lead_id">
        <option value="">— None —</option>
        @foreach ($leads as $l)
            <option value="{{ $l->lead_id }}"
                @selected(old('lead_id', $inquiry->lead_id ?? '') == $l->lead_id)>
                {{ $l->first_name }} {{ $l->last_name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Or Link to Student</label>
    <select name="student_id">
        <option value="">— None —</option>
        @foreach ($students as $s)
            <option value="{{ $s->student_id }}"
                @selected(old('student_id', $inquiry->student_id ?? '') == $s->student_id)>
                {{ $s->user->name ?? 'Student #' . $s->student_id }}
            </option>
        @endforeach
    </select>
    <span style="font-size: 10px; color: #8a93a3; display: block; margin-top: 4px;">
        Must link to at least one — a Lead or a Student.
    </span>
</div>

<div class="form-group">
    <label>Subject *</label>
    <input type="text" name="inquiry_subject" value="{{ old('inquiry_subject', $inquiry->inquiry_subject ?? '') }}" required>
    @error('inquiry_subject') <span class="error">{{ $message }}</span> @enderror
</div>

<div class="form-group">
    <label>Message *</label>
    <textarea name="inquiry_message" rows="4" required>{{ old('inquiry_message', $inquiry->inquiry_message ?? '') }}</textarea>
    @error('inquiry_message') <span class="error">{{ $message }}</span> @enderror
</div>

<div class="form-group">
    <label>Status *</label>
    <select name="inquiry_status" required>
        @foreach (['New', 'In Progress', 'Resolved', 'Closed'] as $status)
            <option value="{{ $status }}"
                @selected(old('inquiry_status', $inquiry->inquiry_status ?? 'New') == $status)>
                {{ $status }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>Assigned Consultant</label>
    <select name="assigned_consultant_id">
        <option value="">— Unassigned —</option>
        @foreach ($consultants as $consultant)
            <option value="{{ $consultant->consultant_id }}"
                @selected(old('assigned_consultant_id', $inquiry->assigned_consultant_id ?? '') == $consultant->consultant_id)>
                {{ $consultant->user->name ?? 'Consultant #' . $consultant->consultant_id }}
            </option>
        @endforeach
    </select>
</div>