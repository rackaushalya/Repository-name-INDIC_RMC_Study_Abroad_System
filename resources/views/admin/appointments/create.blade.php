<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Appointment | INDIC RMC</title>

    @include('components.page-style')
    @include('components.sidebar-style')
</head>
<body>

@include('components.admin-sidebar')

<main class="main">

    <x-admin-topbar current="Appointments" />

    <section class="pg">

        <div class="pg-head">
            <div>
                <h1>Add Appointment</h1>
                <p>Schedule a consultation between a student and a consultant.</p>
            </div>

            <div class="pg-actions">
                <a href="{{ route('admin.appointments.index') }}" class="pg-btn">
                    <i class="bi bi-arrow-left"></i> Back to appointments
                </a>
            </div>
        </div>

        <div class="pg-card">
            <div class="pg-card-body" style="padding:26px;">

                <form method="POST" action="{{ route('admin.appointments.store') }}">
                    @csrf

                    <div class="pg-form-grid">

                        <div class="pg-group">
                            <label for="student_id">Student *</label>
                            <select id="student_id" name="student_id" class="pg-field" required>
                                <option value="">Select a student</option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->student_id }}" @selected(old('student_id') == $student->student_id)>
                                        {{ trim(($student->user->first_name ?? '') . ' ' . ($student->user->last_name ?? '')) ?: $student->user->email ?? 'Student #' . $student->student_id }}
                                    </option>
                                @endforeach
                            </select>
                            @error('student_id')<div class="pg-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="pg-group">
                            <label for="consultant_id">Consultant *</label>
                            <select id="consultant_id" name="consultant_id" class="pg-field" required>
                                <option value="">Select a consultant</option>
                                @foreach ($consultants as $consultant)
                                    <option value="{{ $consultant->consultant_id }}" @selected(old('consultant_id') == $consultant->consultant_id)>
                                        {{ trim(($consultant->user->first_name ?? '') . ' ' . ($consultant->user->last_name ?? '')) ?: $consultant->user->email ?? 'Consultant #' . $consultant->consultant_id }}
                                    </option>
                                @endforeach
                            </select>
                            @error('consultant_id')<div class="pg-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="pg-group">
                            <label for="appointment_date">Date *</label>
                            <input type="date" id="appointment_date" name="appointment_date" class="pg-field"
                                   value="{{ old('appointment_date') }}" required>
                            @error('appointment_date')<div class="pg-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="pg-group">
                            <label for="appointment_type">Type *</label>
                            <select id="appointment_type" name="appointment_type" class="pg-field" required>
                                @foreach (['Online', 'Physical', 'Phone'] as $type)
                                    <option value="{{ $type }}" @selected(old('appointment_type', 'Online') === $type)>{{ $type }}</option>
                                @endforeach
                            </select>
                            @error('appointment_type')<div class="pg-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="pg-group">
                            <label for="start_time">Start time *</label>
                            <input type="time" id="start_time" name="start_time" class="pg-field"
                                   value="{{ old('start_time', '09:00') }}" required>
                            @error('start_time')<div class="pg-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="pg-group">
                            <label for="end_time">End time *</label>
                            <input type="time" id="end_time" name="end_time" class="pg-field"
                                   value="{{ old('end_time', '10:00') }}" required>
                            @error('end_time')<div class="pg-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="pg-group">
                            <label for="appointment_status">Status</label>
                            <select id="appointment_status" name="appointment_status" class="pg-field">
                                @foreach (['Requested', 'Confirmed', 'Completed', 'Cancelled', 'No Show'] as $status)
                                    <option value="{{ $status }}" @selected(old('appointment_status', 'Requested') === $status)>{{ $status }}</option>
                                @endforeach
                            </select>
                            @error('appointment_status')<div class="pg-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="pg-group">
                            <label for="meeting_link">Meeting link</label>
                            <input type="text" id="meeting_link" name="meeting_link" class="pg-field"
                                   placeholder="https://..." value="{{ old('meeting_link') }}">
                            @error('meeting_link')<div class="pg-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="pg-group full">
                            <label for="student_notes">Student notes</label>
                            <textarea id="student_notes" name="student_notes" class="pg-field" rows="3">{{ old('student_notes') }}</textarea>
                            @error('student_notes')<div class="pg-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="pg-group full">
                            <label for="consultant_notes">Consultant notes</label>
                            <textarea id="consultant_notes" name="consultant_notes" class="pg-field" rows="3">{{ old('consultant_notes') }}</textarea>
                            @error('consultant_notes')<div class="pg-error">{{ $message }}</div>@enderror
                        </div>

                    </div>

                    <div style="display:flex;gap:10px;margin-top:24px;padding-top:20px;border-top:1px solid #f0f1f3;">
                        <button type="submit" class="pg-btn pg-btn-dark">
                            <i class="bi bi-check2"></i> Save appointment
                        </button>
                        <a href="{{ route('admin.appointments.index') }}" class="pg-btn">Cancel</a>
                    </div>

                </form>

            </div>
        </div>

    </section>
</main>

</body>
</html>